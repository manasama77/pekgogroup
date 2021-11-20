<?php if ($this->session->flashdata('success')) { ?>
    <?= $this->session->flashdata('success'); ?> <br />
<?php } ?>

<?php if ($this->session->flashdata('error')) { ?>
    <?= $this->session->flashdata('error'); ?> <br />
<?php } ?>

<form action="<?= base_url('upload'); ?>" method="POST" enctype="multipart/form-data">
    <input type="file" class="form-control" id="path_image" name="path_image" placeholder="GAMBAR PRODUK" accept=".jpg, .png, .jpeg" files required>
    <input type="file" class="form-control" id="path_image_2" name="path_image_2" placeholder="GAMBAR PRODUK" accept=".jpg, .png, .jpeg" files required>
    <input type="file" class="form-control" id="path_image_3" name="path_image_3" placeholder="GAMBAR PRODUK" accept=".jpg, .png, .jpeg" files required>
    <button type="submit">Upload</button>
</form>