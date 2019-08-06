<style>

.badge {
    line-height: inherit;
    white-space: inherit;
}

</style>

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close py-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-content p-">
                <div class="mx-auto">
                    <div class="h3 m-4">
                        <div class="badge badge-success px-3 py-3">
                            <i class="fas fa-check-circle"></i>
                            &nbsp;<?= $msg ?>
                        </div>
                    </div>
                    <!-- <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <!-- <button type="button" class="btn btn-success float-right" data-dismiss="modal"><i class="fas fa-check-circle"></i> OK</button> -->
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    $(".modal").modal('show');
});
</script>