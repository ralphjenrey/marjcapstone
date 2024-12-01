<!-- Add this at the bottom before closing body tag -->
<div class="modal fade" id="genericModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalBody">
            </div>
            <div class="modal-footer" id="modalFooter">
            </div>
        </div>
    </div>
</div>


<script>
      function showModal(title, body, buttons) {
            // Set title
            $('#modalTitle').html(title);

            // Set body
            $('#modalBody').html(body);

            // Clear and set buttons
            $('#modalFooter').empty();
            buttons.forEach(btn => {
                $('#modalFooter').append(`
            <button type="button" 
                    class="btn ${btn.class}" 
                    ${btn.dismiss ? 'data-dismiss="modal"' : ''}
                    onclick="${btn.onClick}">
                ${btn.text}
            </button>
        `);
            });

            // Show modal
            $('#genericModal').modal('show');
        }
</script>