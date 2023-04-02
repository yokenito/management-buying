
// 見積書作成　担当者設定のモーダル
$('#searchperson-btn').on('click', function(){
    var searchperson_name = $('#searchperson-box').val();
    console.log(searchperson_name);
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: `/sample-app-selling-manager/public/people/searchperson`,
        type: "POST",
        data:{
            "searchperson_name" : searchperson_name
        }
    })
        .done(function(data){
            // 検索結果を受け取って一覧を表示
            $('#personsearch-result').empty();
            for(i=0; i < data.length; i++){
                $('#personsearch-result').append('<button class="person-set btn btn-outline-dark ms-2" value="' + data[i].id + '">' + data[i].person_name + '</button>');
            }
            $('.person-set').on('click', function(){
                var person_id = $(this).val();
                var person_name = $(this).text();
                console.log(person_name, person_id);
                $('#set-person').val(person_name);
                $('#set-person-id').val(person_id);
                $('#searchPersonModal').modal('hide');
            });
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            console.log('失敗');
        });
});

$('#clearperson-btn').on('click', function(){
    $('#personsearch-result').empty();
    $('#searchperson-box').val('');
    $('#set-person').val('');
    $('#set-person-id').val('');
});


// 見積書作成　顧客設定のモーダル
$('#searchclient-btn').on('click', function(){
    var searchclient_name = $('#searchclient-box').val();
    console.log(searchclient_name);
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: `/sample-app-selling-manager/public/clients/searchclient`,
        type: "POST",
        data:{
            "searchclient_name" : searchclient_name
        }
    })
        .done(function(data){
            // 検索結果を受け取って一覧を表示
            $('#clientsearch-result').empty();
            for(i=0; i < data.length; i++){
                $('#clientsearch-result')
                    .append('<div><button class="client-set btn btn-link ms-2 c-black" value="' + data[i].id + '">' + data[i].client_name + '</button></div>');
            }
            $('.client-set').on('click', function(){
                var client_id = $(this).val();
                var client_name = $(this).text();
                console.log(client_name, client_id);
                $('#set-client').val(client_name);
                $('#set-client-id').val(client_id);
                $('#searchClientModal').modal('hide');
            });
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            console.log('失敗');
        });
});

$('#clearclient-btn').on('click', function(){
    $('#clientsearch-result').empty();
    $('#searchclient-box').val('');
    $('#set-client').val('');
    $('#set-client-id').val('');
});

// 見積書作成　製品設定のモーダル
$('#searchproduct-btn').on('click', function(){
    var searchproduct_name = $('#searchproduct-box').val();
    console.log(searchproduct_name);
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: `/sample-app-selling-manager/public/products/searchproduct`,
        type: "POST",
        data:{
            "searchproduct_name" : searchproduct_name
        }
    })
        .done(function(data){
            // 検索結果を受け取って一覧を表示
            $('#productsearch-result').empty();
            for(i=0; i < data.length; i++){
                $('#productsearch-result')
                    .append('<div><button class="product-set btn btn-link ms-2 c-black" value="' + data[i].id + '">' + data[i].product_id +'：' + data[i].product_name + '</button></div>');
            }
            $('.product-set').on('click', function(){
                var product_id = $(this).val();
                var product_name = $(this).text();
                console.log(product_name, product_id);
                $('#set-product').val(product_name);
                $('#set-product-id').val(product_id);
                $('#searchProductModal').modal('hide');
            });
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            console.log('失敗');
        });
});

