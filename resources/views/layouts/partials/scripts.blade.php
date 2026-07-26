<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('globalDeleteForm');

        deleteModal.addEventListener('show.bs.modal', function(event) {

            const button = event.relatedTarget;
            const url = button.getAttribute('data-url');

            deleteForm.setAttribute('action', url);

        });

    });
</script>
