( function( $ ) {

    /* 
        WP Media insert And remove image
    */
   function Select_WP_Media(){

        let frame,
           addImgLink = $( `.img-select` ),
           delImgLink = $( `.img-remove` ),
           imgContainer = $( `.img-default` ),
           imgIdInput = $( `.inpt-img-1` )
       
   
        addImgLink.click(function (e) { 
           
           // If the media frame already exists, reopen it.
           var buttom_clicked = $(this)
            // Create a new media frame
            frame = wp.media({
               title: 'Selecione a Imagem para ser usada no slide',
               button: {
               text: 'Usar esta Imagem'
               },
               multiple: false  // Set to true to allow multiple files to be selected
            })
   
            // When an image is selected in the media frame...
            frame.on( 'select', function() {           
               // Get media attachment details from the frame state
               var attachment = frame.state().get('selection').first().toJSON();
                //console.log(attachment)

                if( attachment.height > 300 ){
                    // Send the attachment URL to our custom image input field.target.parentElement.children
                    buttom_clicked.parent().find(`img`).remove()
                    buttom_clicked.parent().prepend( `<img class="imge-selected-1" src="${attachment.sizes.thumbnail.url}">` )
                }else{
                    // Send the attachment URL to our custom image input field.target.parentElement.children
                    buttom_clicked.parent().find(`img`).remove()
                    buttom_clicked.parent().prepend( `<img class="imge-selected-1" src="${attachment.url}">` )
                }
               
                // Send the attachment id to our hidden input
                buttom_clicked.parent().parent().find(`input`).val( attachment.url )

                let nameoptionsave = buttom_clicked.parent().parent().find(`input`).attr(`name`)
                var dataSend = $( `.form_options` ).serialize();
                dataSend += `&action=insert_slides`
                $.post( ajaxurl, dataSend).done(function( data ) {
                    console.log(`%cResposta do Wordpress: ${data}`, "color: red; font-style: italic; font-weight: bolder;");
                });
               
            })   
            // Finally, open the modal on click
            if( $(this).hasClass('img-select') ){
                frame.open()
                return false
            }    
            //buttom_clicked = ''
       })

       // DELETE IMAGE LINK
        delImgLink.on( 'click', function( event ){
   
            event.preventDefault()

            let buttom_clicked_remove = $(this)

            // Clear out the preview image
            $(this).parent().find( `img` ).remove()

            // Un-hide the add image link
            $(this).parent().prepend( `<img class="imge-selected-1" src="${theme_directory}/assets/images/admin/woocommerce-placeholder-300x300.png">` );

            /* // Hide the delete image link
            delImgLink.addClass( 'hidden' ); */

            // Delete the image id from the hidden input
            $(this).parent().parent().find(`input`).val( '' )

        });
   }

    /* 
        Add new Image to Slide
    */

    let Images_Count,
    Images_container = $( `.slides` )

    $( `.theme-add-image` ).click(function (e) { 
        e.preventDefault()
        Images_Count = $( `.slides > div` ).length

        if( Images_Count > 0 ){
            Images_Count++
            
            let new_image = `<div class="slide-${Images_Count}">
                <span>
                    <label>Imagem - ${Images_Count}</label>
                    <input type="hidden" class="inpt-img-${Images_Count}" name="options_theme[slides][image-${Images_Count}]">
                    <div class="img-default">
                        <img src="${theme_directory}/assets/images/admin/woocommerce-placeholder-300x300.png">
                        <button class="img-select">Selecionar Imagem</button>
                        <button class="img-remove">Remover Imagem</button>
                    </div>
                </span>
            </div>`
                
            $(this).before(new_image)

            $( `.slides label` ).click(function (e) { 
                e.preventDefault()
                $( `.slides > div[class*="slide-"]` ).removeClass( `slideactived` )
                $( this ).parents( `span` ).parent().addClass( `slideactived` )
            })

            Select_WP_Media()
        }
    })

    $( `.slides label` ).click(function (e) { 
        e.preventDefault()
        $( `.slides > div[class*="slide-"]` ).removeClass( `slideactived` )
        $( this ).parents( `span` ).parent().addClass( `slideactived` )
    })

    Select_WP_Media()

}) (jQuery)
