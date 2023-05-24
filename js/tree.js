let url = 'api.php';

window.onload = function(){
  let tree = document.querySelector('.tree');

  let green = document.querySelector('.green_btn');
  let orange = document.querySelector('.orange_btn');
  let red = document.querySelector('.red_btn');

  if(orange){
    orange.addEventListener('click', (ev)=>{
      let active = tree.querySelector('.active');
      if(active){
        dblclick(active);
      }
    });
  }

  if(green){
    green.addEventListener('click', (ev)=>{
      addItem();
    });
  }

  if(red){
    red.addEventListener('click', (ev)=>{
      let active = tree.querySelector('.active');
      // console.log('active', active);
      let cat = active.dataset.cat;
      let parent = active.dataset.parent;
      let div = active.closest('div');
      // console.log('div', div, cat, parent);
      div.remove();
      geturl(url, {type: 'remove', parent_id: parent, id: cat}, function () {
        let popup = document.querySelector('.popup');
        if(popup.style.display == 'block'){
          let modal = document.getElementById('modal');
          if(modal){
            modal.remove();
            popup.style.display = 'none';
          }
        }
      });
    });
  }

  if(tree){
      tree.addEventListener('click', (ev)=>{
          let elem = ev.target;
          console.log(ev.target);

          if(elem.classList.contains('hide-brand')){
            let select = document.querySelector('.active');
            if(select){
              // console.log('select', select);
              select.classList.remove('active');
            }

          }

          if(elem.classList.contains('item')){
              // console.log('active class add');

              let popup = document.querySelector('.popup');
              if(popup.style.display == 'block'){
                let modal = document.getElementById('modal');
                let one = modal.firstElementChild;
                one.remove();
                modal.insertAdjacentHTML('afterbegin', `<div class="one">Название: ${elem.textContent}</div>`)

              }else {
                let tpl = `<div id="modal">
                        <div class="one">Название: ${elem.textContent}</div>
                        <div class="two">Закрыть</div>
                    </div>`;
                popup.insertAdjacentHTML('afterbegin', tpl);
                popup.style.display = 'block';

                let close = document.querySelector('.two');
                close.addEventListener('click', (ev)=>{
                  popup.style.display = 'none';
                  let modal = document.getElementById('modal');
                  modal.remove();
                });
              }


              let items = document.querySelectorAll('.item');
              items.forEach((item) => {
                  item.classList.remove('active');
              });
              elem.classList.add('active');
          }

          if(elem.classList.contains('tree_open')){
            console.log('click tree open');
            let parent = elem.parentElement;
            parent = elem.nextElementSibling.querySelector('.main');
            console.log('parent', parent);

            if(parent.classList.contains('show')){
              parent.classList.remove('show');
              elem.classList.remove('tree_close');
            }else{
              parent.classList.add('show');
              elem.classList.add('tree_close');
            }
          }

      });

      let welcome = document.getElementById('welcome');
      if(welcome.dataset.auth == 1){
        tree.addEventListener('dblclick', (ev)=>{
          let elem = ev.target;
          dblclick(elem);
        });
      }

  }


};


function dblclick(elem, add=false){
  if(elem.classList.contains('item')){
    console.log('double click', elem.textContent);
    let txt = elem.textContent;
    let edit_class = "edit-item-tree";
    // let inp = document.createElement('input');
    let parent = elem.parentElement;
    
    // elem.style.display = 'none';
    elem.classList.add('hide');
    parent.insertAdjacentHTML('afterbegin', `<input class="${edit_class}" type="text" value=${txt}>`);
    let edit_item = document.querySelector(`.${edit_class}`);
    edit_item.select();
    
    edit_item.addEventListener('blur', (ev)=>{
      console.log('потеряли фокус');
      // console.log(ev.target.value);
      let val = ev.target.value;
      console.log('val=', val, 'cat=',elem.dataset.cat, 'parent=', elem.dataset.parent);
      if(val != txt){
        elem.textContent = val;
        geturl(url, {type: 'edit', id: elem.dataset.cat, parent_id: elem.dataset.parent, title: val});
      }
      if(add){
        geturl(url, {type: 'add', parent_id: elem.dataset.parent, title: val}, function(id){
          elem.dataset.cat = id;
        });
      }
      elem.classList.remove('hide');
      edit_item.remove();
    });
    // console.log('edit', edit_item);
  }
}

async function geturl(url, opt, callback){
  let data = {
    type: opt.type || '',
    id: opt.id || '',
    parent_id: opt.parent_id || '',
    title: opt.title || ''
  };

  let response = await fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json;charset=utf-8'
    },
    body: JSON.stringify(data)
  });

  let commits = await response.json();
  if(callback){
    callback(commits.id);
  }
  
  console.log(commits.id, commits);
  return commits;
}


function addItem(){
    let tree = document.querySelector('.tree');
    let active = tree.querySelector('.active');

    let first;

    if(active){
      let data_cat = active.dataset.cat;
      console.log('active', active);
      let sibl = active.nextElementSibling;
    
      if(sibl){
        sibl.classList.add('show');
      }else{
        let parent = active.parentElement.parentElement;

        parent.style.display = 'flex';
        parent.classList.add('hide-brand'); //tree_open tree_close
        parent.insertAdjacentHTML('afterbegin', `<span class="tree_open tree_close"></span>`)

        sibl = active;
        active.insertAdjacentHTML('afterend', `<ul class="main show"></ul>`);
        sibl = active.nextElementSibling;
        
      }
      
      sibl.insertAdjacentHTML('afterbegin', 
      `<div><li><a href="#" class="item" data-cat="" data-parent="${data_cat}">newitem</a></li></div>`);

      first = sibl.firstElementChild.querySelector('.item');
      // dblclick(first, true);
    }else{
      let ul = tree.firstElementChild;

      let node = null;
      if(ul){
        node = ul.lastChild.querySelector('.item');
      }

      if(node){
        let tpl = `<div><li><a href="#" class="item" data-cat="" data-parent="${node.dataset.parent}">newitem</a></li></div>`;
        ul.insertAdjacentHTML('beforeend', tpl);
        let list = document.querySelectorAll('.tree ul div:last-child li>a');
        // console.log('list', list[list.length-1]);
        first = list[list.length-1];
      }else{
        let tpl_new = `<ul class="main"><div><li><a href="#" class="item" data-cat="" data-parent="0">newitem</a></li></div></ul>`;
        tree.insertAdjacentHTML('afterbegin', tpl_new);
        first = document.querySelector('.tree ul div > li>a');
      }

    }
  dblclick(first, true);
}