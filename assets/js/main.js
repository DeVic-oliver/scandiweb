$(()=>{
    $('#store-product').on('click', ()=>{
        $('#store-product-form').trigger('submit');
    })
    
    const cardTypes =  Array.from($('.product-type-card'));
    $('#productType').on('change', ()=>{
        var selectedProductType = $('#productType').find(":selected").text().toLowerCase();
        cardTypes.forEach(element => {
            let cardTypeID = element.id.toLowerCase(); 
            if(cardTypeID === selectedProductType){
                $('#'+element.id).css("display", "block");
            }else{
                $('#'+element.id).css("display", "none");
            }
        });
    })

    $('#mass-delete').on('click', ()=>{
        $('#products-select-form').trigger('submit');
    })
    
})