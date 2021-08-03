<script>

    $(document).on('click', '#manageProduct', function(){
        //alert('click');
        $('#target-content').load('https://localhost/miniProject1_PHP/?controller=Product&action=all'); //gọi controller
    })

    $(document).on('blur', '#name', function(){
        //console.log('blur');
        if($("input[name=name]").val() == ""){
            $('#name-error').text('Please enter name!');
            $('input#name').focus();
        }else{
            $('#name-error').text('');
        }
    })

    $(document).on('blur', '#price', function(){
        if($("input[name=price]").val() == ""){
            $('#price-error').text('Please enter price!');
            $('input#price').focus();
        }else if($("input[name=price]").val() <= 0){
            $('#price-error').text('Invalid price. Re-enter!');
            $('input#price').focus();
        }else{
            $('#price-error').text('');
        }
    })

    $(document).on('blur', 'textarea', function(){
        if($("textarea").val() == ""){
            $('#des-error').text('Please enter description!');
            $('textarea').focus();
        }else{
            $('#des-error').text('');
        }
    })

    /*set label for file input if change*/
    $(document).on('change', '.custom-file-input', function() {
        let image = $("input[name=image]").prop('files')[0]['name'];
        $('.custom-file-label').text(image);
    })

    /**reset input in modal in case after click edit but not update, then click add */
    $(document).on('click', 'button.close', function() {
        $("input[name=id]").val('');
        $("input[name=name]").val('');
        $("input[name=price]").val('');
        $("textarea").val('');
        $('.custom-file-label').text('');

        $('#name-error').text('');
        $('#price-error').text('');
        $('#des-error').text('');
        $('#image-error').text('');
    })

    /* click save */
    $(document).on('click', '.btn-primary.add', function() {

        let id = $("input[name=id]").val();
        let name = $("input[name=name]").val();
        let price = $("input[name=price]").val();
        let des = $("textarea").val();
        let image = $("input[name=image]").prop('files')[0];

        console.log(image);
        
        if(name == "" || price == "" || des==""){
            alert("Please enter fully!");
            return;
        }

        //console.log(image['name']);
        let fd = new FormData();
        fd.append('id', id);
        fd.append('name', name);
        fd.append('price', price);
        fd.append('des', des);
        fd.append('image', image);

        if(id!="" && image==null){
            fd.append('imageUrl',  $('.custom-file-label').val());
        }

        $.ajax({
            url: 'https://localhost/miniproject1_PHP/?controller=Product&action=add',
            type: 'POST',
            processData: false,
            contentType: false,
            data: fd,
            success: function(response) {
                var response = JSON.parse(response);
                console.log(response);
                if (response.statusCode == 500) {
                    //alert(JSON.stringify(response.error));
                    alert('not ok');
                }

                if(response.statusCode == 400){
                    console.log(response.errors);
                    $('#name-error').text(response.errors['nameErr']);
                    $('#price-error').text(response.errors['priceErr']);
                    $('#image-error').text(response.errors['imageErr']);
                    $('#des-error').text(response.errors['desErr']);
                }

                if (response.statusCode == 200) {
                    $('.modal.fade').modal('toggle');
                    $("input[name=id]").val('');
                    $("input[name=name]").val('');
                    $("input[name=price]").val('');
                    $("textarea").val('');
                    $('.custom-file-label').text('');
                    alert('add ok');
                    let stt = $('table tr:last-child td:first-child').html();
                    $('#dataTable tr:last').after(`
                        <tr id="tr_${response.last_id}">
                            <td>${++stt}</td>
                            <td>${name}</td>
                            <td>${price}</td>
                            <td><img style="max-width: 150px;" src="../../upload_image/${image['name']}"/></td>
                            <td>${des}</td>
                            <td>
                                <a href="#" class="edit-button" onclick="return editProduct(${response.last_id});"><i class="far fa-edit" style="font-size: 20px; margin-right: 10px;"></i></a>
                                <a href="#" class="delete-button" onclick="return deleteProduct(${response.last_id});"><i class="fas fa-trash-alt" style="font-size: 20px; color: red;"></i></a>
                            </td>
                        </tr>
                    `);
                }

                if (response.statusCode == 300) {
                    $('.modal.fade').modal('toggle');
                    $("input[name=id]").val('');
                    $("input[name=name]").val('');
                    $("input[name=price]").val('');
                    $("textarea").val('');
                    $('.custom-file-label').text('');

                    //update view
                    $('#tr_' + id).find("td").eq(1).html(name);
                    $('#tr_' + id).find("td").eq(2).html(price);
                    $('#tr_' + id).find("td").eq(3).html('<img style="max-width: 150px;" src="../../upload_image/' + image['name'] + '" />');
                    $('#tr_' + id).find("td").eq(4).html(des);
                    alert('Update successfully');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    })

    /**click edit, send param  */
    function editProduct(x) {
        $.ajax({
            url: 'https://localhost/miniproject1_PHP/?controller=Product&action=edit',
            type: 'POST',
            data: {
                'id': x
            },
            success: function(response) {
                var response = JSON.parse(response);
                console.log("response"+ response);
                $("input[name=id]").val(response.data[0]);
                $("input[name=name]").val(response.data[1]);
                $("input[name=price]").val(response.data[2]);
                $("textarea").val(response.data[4]);
                $('.custom-file-label').text(response.data[3].slice(13));
                $('.modal.fade').modal('show');
            }
        })
    }

    /** click delete */
    function deleteProduct(x) {
        var selection = confirm('Are you sure to delete this product?');
        if (selection) {
            $.ajax({
                url: 'https://localhost/miniproject1_PHP/?controller=Product&action=delete',
                type: 'POST',
                data: {
                    id: x
                },
                success: function(response) {
                    $('#tr_' + x).remove();
                }
            })
        }
    }

    $(document).on('blur', 'input#username', function(){
        if($("input[name=username]").val() == ""){
            $('#username-error').text('Enter username');
            $('input#username').focus();
        }else{
            $('#username-error').text('');
        }
    })

    $(document).on('blur', 'input#password', function(){
        if($("input[name=password]").val() == ""){
            $('#password-error').text('Enter password');
            $('input#password').focus();
        }else{
            $('#password-error').text('');
        }
    })

    $(document).on('focus', 'input#password', function(){
        $('#buttonSubmit').removeAttr('disabled');
    })
</script>