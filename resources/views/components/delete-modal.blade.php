<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <form id="globalDeleteForm" method="POST" action="">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">
                    Are you sure you want to delete this data?
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-danger">
                        Delete
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>
