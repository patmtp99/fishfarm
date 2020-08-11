<?= $this->extend('templates/dashboard') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-6">
        <form action="" method="post">
            <div class="form-group">
                <label for="FishName">Fish Name</label>
                <input class="form-control" type="text" required name="fishName">
            </div>
            <div class="form-group">
                <label for="my-textarea">Fish Description</label>
                <textarea id="my-textarea" class="form-control" required name="fishDescription" rows="3"></textarea>
            </div>
            
            <div class="btn-group" role="group" aria-label="Button group">
                <button name="submit" value="submit" >Submit</button>
            </div>
        </form>
    </div>   
</div>
    
<?= $this->endSection() ?>
