<?php
/* Template Name: BSIT Games Zone */
get_header();

// Check if the user is logged in
if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    echo '<div class="user-info">Welcome, ' . esc_html($current_user->display_name) . '</div>';
} else {
    echo '<div class="user-info">Please log in to play the games.</div>';
    exit;
}

?>

<div id="games-zone">
    <h2>Welcome to BSIT Games Zone</h2>

    <div id="game-options">
        <button id="playWithComputer">Play with Computer</button>
        <button id="waitForOpponent">Wait for Opponent</button>
    </div>

    <div id="gameStatus" style="display:none;"></div>
    <div id="chessboardContainer" style="display:none;">
        <div id="board1" style="width: 400px;"></div>
    </div>

    <div id="loading" style="display:none;">Loading...</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chess.js/0.10.3/chess.min.js"></script>

<!-- Use local or CDN ChessboardJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/chessboardjs/1.0.0/chessboard-1.0.0.min.js"></script>

<!-- FontAwesome from CDN without CORS issues -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<script>
$(document).ready(function() {
    // Ensure Chessboard is loaded and can be used
    if (typeof ChessBoard === 'undefined') {
        console.error('ChessBoard library not loaded properly');
        return;
    }

    const boardElement = $('#board1')[0];
    const board = ChessBoard(boardElement);
    const chess = new Chess();

    $('#playWithComputer').click(function() {
        $('#gameStatus').show().text('Playing against computer...');
        $('#chessboardContainer').show();
        $('#loading').hide();
        playAgainstComputer();
    });

    $('#waitForOpponent').click(function() {
        $('#gameStatus').show().text('Waiting for opponent...');
        $('#chessboardContainer').show();
        $('#loading').hide();
        waitForOpponent();
    });

    function playAgainstComputer() {
        chess.reset();
        board.position(chess.fen());
        board.onMoveEnd = function() {
            if (chess.game_over()) {
                alert('Game Over');
            } else {
                const moves = chess.legal_moves();
                const move = moves[Math.floor(Math.random() * moves.length)];
                chess.uci(move);
                board.position(chess.fen());
            }
        };
    }

    function waitForOpponent() {
        $('#loading').show();

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            method: 'POST',
            data: {
                action: 'wait_for_opponent'
            },
            success: function(response) {
                if (response.success) {
                    $('#loading').hide();
                    $('#gameStatus').show().text('Game Started!');
                    chess.reset();
                    board.position(chess.fen());
                } else {
                    $('#gameStatus').show().text('No opponent found. Please try again later.');
                }
            },
            error: function() {
                $('#loading').hide();
                $('#gameStatus').show().text('Error connecting to opponent.');
            }
        });
    }
});
</script>

<?php
get_footer();
?>
