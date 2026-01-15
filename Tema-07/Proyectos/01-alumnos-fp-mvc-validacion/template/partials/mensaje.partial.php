<?php if (isset($this->notify)):?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Mensaje </strong> <?= $this->notify; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>   
        </div>
<?php endif;?>