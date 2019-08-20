( function( $ ) {
function img_on_child(target) {
    if( $(target).hasClass(`has-image`) ) {
        let url = this.attr('data-image')
        console.log('Tem imagem')
    }
}
}) (jQuery)

function simple_slides(element_next_target, element_prev_target, number_of_items, berder_offset){
    let elm = null,
    valtrs = 0,
    direct,
    checklength_itens = [],
    target_next_set = element_next_target.replace(`.`, ``),
    target_prev_set = element_prev_target.replace(`.`, ``),
    target_container,
    target_wraper = `simple-wrapper`,
    target_item = `simple-item`
    var class_by_prev = document.getElementsByClassName(target_next_set)
    class_by_prev = class_by_prev[0].nextElementSibling.childNodes[1].childNodes
    var val_slides = 0,
    list_itens_prev = []

    $(element_prev_target).each(function (index, element) {
        // element == this
        //var class_by_prev = document.getElementsByClassName(`${target_item}`)

        for (let i in class_by_prev) {
            if((" " + class_by_prev[i].className + " ").replace(/[\n\t]/g, " ").indexOf(target_item) > -1){
                val_slides++
                list_itens_prev.push(class_by_prev[i])
            }
            /* if(itemnextsibling1[key][`offsetWidth`]){
                checklength_itens.push(itemnextsibling1[key].offsetWidth)
                valtrnext.push(itemnextsibling1[key])
            } */
        }
        if( val_slides === number_of_items ) {
            $(this).css(`opacity`, `.3`)
        }     
    })
    

    function animSlide(valtrsnsform, targetof, direction, border){       
        let dir
        direction  === 'next' ? dir = '+' : direction === 'prev' ? dir = '-' : ''
        let goto

        if( valtrsnsform > -10 && (valtrsnsform < 10) ){
            goto = 0
        }else{
            if( direction  === 'next' ){
                goto = valtrsnsform+border
            }else{
                goto = valtrsnsform-border
            }
        }

        //console.log(`Borda antes: ${valtrsnsform}\nBorda Depois: ${goto}`)

        let stylesanim = {
            transition: `all 500ms`,
            transform: `translateX(${goto}px)`
        }
        targetof.css(stylesanim)
    }
    
    $(element_prev_target).click(function (e) { 
        e.preventDefault()
        let targetlnX
        
        targetlnX = $(this).next().next().find(`.${target_wraper}`)
        /* console.log(`Target Next`)
        console.log(targetlnX) */
        
        let valtrl = list_itens_prev           
        
        /* console.log(`display`)
        console.log(valtrl) */

        if ( elm ) {
            if( direct === 'prev' ){
                if( elm === (valtrl.length - number_of_items) ){
                    elm = null
                    valtrs = 0 
                    //console.log(`cheio ${valtrl.length}`)
                }else{
                    elm++
                    valtrs = valtrs - valtrl[elm][`offsetWidth`]
                    //console.log(`Meu e esta na posição ${elm}`)
                }
            }else{
                if( elm === 0 ){
                    elm = null
                    valtrs = 0                
                }else{
                    elm--
                    valtrs = valtrs - valtrl[elm][`offsetWidth`]
                }
            }
        } else {
            elm++
            direct = 'prev' 
            valtrs = valtrs - valtrl[elm][`offsetWidth`]
        }
        animSlide(valtrs, targetlnX, direct, berder_offset)
    })

    $(element_next_target).click(function (e) { 
        e.preventDefault()
        let targnext
        var itemsimple = document.getElementsByClassName(`${target_item}`)
        var itemnextsibling1 = document.getElementsByClassName(target_next_set)
        itemnextsibling1 = itemnextsibling1[0].nextElementSibling.childNodes[1].childNodes

        let valtrnext = []
        if( $(this).next().hasClass(target_prev_set) ){
            targnext = $(this).next().next().find(`.${target_wraper}`)
        }else{
            targnext = $(this).next().find(`.${target_wraper}`)
        }

        for (const key in itemnextsibling1) {
            if(itemnextsibling1[key][`offsetWidth`]){
                checklength_itens.push(itemnextsibling1[key].offsetWidth)
                valtrnext.push(itemnextsibling1[key])
            }
        }
        var sum = 0;
        checklength_itens.forEach(function(num){sum+=parseFloat(num) || 0;})

        if( valtrs < 0 ){
            
            if ( elm ) {
                if( direct === 'next' ){
                    if( elm === (valtrnext.length - 1) ){
                        elm = null
                        valtrs = 0 
                        //console.log(`cheio ${valtrnext.length}`)
                    }else{
                        elm++
                        valtrs = valtrs + valtrnext[elm][`offsetWidth`]
                        //console.log(`Meu e esta na posição ${elm}`)
                    }
                }else{
                    if( elm === 0 ){
                        elm = null
                        valtrs = 0                
                    }else{
                        elm--
                        valtrs = valtrs + valtrnext[elm][`offsetWidth`]
                    }
                }                       
            } else {
                elm++
                //console.log(valtrl)
                direct = 'next' 
                valtrs = valtrs + valtrnext[elm][`offsetWidth`]
            }
    
            animSlide(valtrs, targnext, direct, berder_offset)  
        }
         
    })
}