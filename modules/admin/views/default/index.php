<div class="admin-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <a class="btn btn-primary" href="index.php?r=admin/brand">Brands</a>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
