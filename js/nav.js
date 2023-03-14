

(function(){
    const listElements = document.querySelectorAll('.menu_item-show');
    const list = document.querySelector('.menu_links');
    const menu = document.querySelector('.menu_hamburguer');
    

    const addClick = ()=>{
        listElements.forEach(element =>{
            element.addEventListener('click', () => {

                let subMenu = element.children[1]

                // console.log(subMenu)
                let height = 0;
                element.classList.toggle('menu_item-active')

                console.log(subMenu.clientHeight)
                

                if(subMenu.clientHeight === 0){
                    height = subMenu.scrollHeight
                    // subMenu.style.margin = `${height}px`;
                }

                // subMenu.style.height = `${height}px`;

            })
        })
    }
    
    function mostrar () {
        list.classList.toggle('none')
    }
    document.querySelector('.menu_hamburguer').onclick = function (){
        mostrar();
    }
    

   
    addClick();

})();

