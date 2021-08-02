<?php define('link_to_image_folder','../../') ?>
<div style="display: flex; width: 100%; justify-content: space-between; margin-bottom: 5px;">
    <div>
        <button data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-outline-success">Add new product</button>
    </div>
    <div class="form-outline">
        <input type="search" id="form1" class="form-control" placeholder="Search product..." />
    </div>
</div>

<table class="table table-bordered" id="dataTable">
    <thead class="thead-dark">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Image</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i = 0; $i < sizeof($products); $i++) { ?>
            <tr id="tr_<?php echo $products[$i]['id']; ?>">
                <td><?php echo ($i + 1) ?></td>
                <td><?php echo $products[$i]['name']; ?></td>
                <td><?php echo $products[$i]['price']; ?></td>
                <td><img style="max-width: 150px;" src="<?php echo link_to_image_folder . $products[$i]['image']; ?>" /></td>
                <td><?php echo $products[$i]['des']; ?></td>
                <td>
                    <a href="#" class="edit-button" onclick="return editProduct(<?php echo $products[$i]['id']; ?>);">
                        <i class="far fa-edit" style="font-size: 20px; margin-right: 10px;"></i>
                    </a>
                    <a href="#" class="delete-button" onclick="return deleteProduct(<?php echo $products[$i]['id'] ?>);">
                        <i class="fas fa-trash-alt" style="font-size: 20px; color: red;"></i>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!--Modal form-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="hidden" name="id">
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required/>
                        <span style="color: red;font-style: italic;" id="name-error"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="price" class="col-form-label">Price:</label>
                        <input type="number" class="form-control" id="price" name="price" required/>
                        <span style="color: red;font-style: italic;" id="price-error"></span>
                    </div>
                    <div class="form-group">
                        <label for="imageSelect">Select image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imageSelect" name="image" accept="image/*" required/>
                                <label class="custom-file-label" for="image"></label>
                            </div>
                            <span style="color: red;font-style: italic;" id="image-error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="des" class="col-form-label">Description:</label>
                        <textarea class="form-control" id="des" name="des" required></textarea>
                        <span style="color: red;font-style: italic;" id="des-error"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary add">Save</button>
            </div>
        </div>
    </div>
</div>