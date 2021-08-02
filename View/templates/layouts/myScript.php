<script>
    $(document).on('click', '#manageProduct', function(){
        //alert('click');
        $('#target-content').load('http://localhost/miniproject1/?controller=Product&action=all'); //gọi controller
    })

    /*set label for file input if change*/
    $(document).on('change', '.custom-file-input', function() {
        let image = $("input[name=image]").prop('files')[0]['name'];
        $('.custom-file-label').text(image);
    })

        /* click save */
    $(document).on('click', '.btn-primary.add', function() {

        let id = $("input[name=id]").val();
        let name = $("input[name=name]").val();
        let price = $("input[name=price]").val();
        let des = $("textarea").val();
        let image = $("input[name=image]").prop('files')[0];

        console.log(image);
        //return;
        //console.log($("input[name=image]")[0].files);
        //return;

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

        $.ajax({
            url: 'http://localhost/miniproject1/?controller=Product&action=add',
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

</script>