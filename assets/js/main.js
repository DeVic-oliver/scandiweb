$(()=>{
    $('.product-card').on('click', (e)=>{
        let checkboxElement = $(e.currentTarget).find('.delete-checkbox');
        let checkboxProperty = checkboxElement.prop('checked');
        checkboxElement.prop('checked', !checkboxProperty);
        $(e.currentTarget).toggleClass("product-card-selected");
    })

    $('#store-product').on('click', ()=>{
        $('#product_form').trigger('submit');
    })
    
    const cardTypes =  Array.from($('.product-type-card'));
    $('#productType').on('change', ()=>{
        var selectedProductType = $('#productType').find(":selected").text().toLowerCase();
        cardTypes.forEach(element => {
            let cardTypeID = element.id.toLowerCase(); 
            if(cardTypeID === selectedProductType){
                $('#'+element.id).css("display", "block");
                $('#'+element.id).removeAttr("disabled");
            }else{
                $('#'+element.id).attr("disabled", "disabled");
                $('#'+element.id).css("display", "none");
            }
        });
    })

    $('#mass-delete').on('click', ()=>{
        $('#products-select-form').trigger('submit');
    })
    
})