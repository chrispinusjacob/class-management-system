jQuery(document).ready(function($) { // Opening for document.ready

    // Function to Confirm Deletion of a Note
    function confirmDelete(button) { // Opening for confirmDelete function
        if (confirm("Are you sure you want to delete this note?")) { // Opening for confirm check
            const noteUrl = button.getAttribute('data-note-url');
            const postId = button.getAttribute('data-post-id');

            jQuery.ajax({
                url: ajax_obj.ajax_url,
                type: 'POST',
                data: {
                    action: 'delete_note',
                    note_url: noteUrl,
                    post_id: postId,
                },
                success: function(response) { // Opening for success function
                    if (response.success) {
                        alert('Note deleted successfully');
                        // Remove the deleted note's element from the display
                        jQuery(button).closest('li').remove();
                    } else {
                        alert('Failed to delete the note');
                    }
                }, // Closing for success function
                error: function() { // Opening for error function
                    alert('An error occurred while deleting the note');
                } // Closing for error function
            }); // Closing for ajax call
        } // Closing for confirm check
    } // Closing for confirmDelete function

    // Event handler for download button
    $(document).on('click', '.download-button', function(e) { // Opening for download button event
        e.preventDefault();
        
        var noteId = $(this).data('note-id'); // Retrieve note ID
        var postId = $(this).data('post-id'); // Retrieve post ID
        var noteUrl = $(this).data('note-url'); // Retrieve note URL

        if (!noteId || !postId) {
            console.error('Note ID or Post ID missing.');
            return;
        }

        // AJAX request to increment download count
        $.ajax({
            url: ajax_obj.ajax_url,
            type: 'POST',
            data: {
                action: 'increment_download_count',
                note_id: noteId,
                post_id: postId,
                nonce: ajax_obj.nonce
            },
            success: function(response) { // Opening for success function
                if (response.success) {
                    $(`[data-note-id="${noteId}"]`).closest('.note-item').find('.download-count').text(response.new_count + ' downloads');
                    window.open(noteUrl, '_blank'); // Open the PDF in a new tab
                } else {
                    console.error('Failed to update download count:', response.data.message);
                }
            }, // Closing for success function
            error: function(jqXHR, textStatus, errorThrown) { // Opening for error function
                console.error('Error updating download count:', textStatus, errorThrown);
            } // Closing for error function
        }); // Closing for ajax call
    }); // Closing for download button event handler

}); // Closing for document.ready
