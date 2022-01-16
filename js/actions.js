const WHITE = 'white';
const BLACK = 'black';

export let action={
    title_blocks:[],
    links:[],
    current_page:'terms',
    container:[],
    theme:WHITE,
    init:function (title_blocks,blocks) {
        this.title_blocks =title_blocks;
        this.links = blocks;

        this.title_blocks.forEach(el=>{
            let block = document.getElementById(el);
            this.container.push(block);
        })
    },
    showBlock:function(id_block){
        let current_id_block = '#'+id_block;
        this.container.forEach(el=>{
            if (el.id === id_block) el.classList.remove('hidden');
        });
        this.links.forEach(el=>{
            if (el.dataset.block === id_block) el.classList.add('active');
        });
    },
    hideBlocks:function(){
        this.links.forEach(el=>{
            if (el.classList.contains('active')) el.classList.remove('active');
        });

        this.container.forEach(el=>{
            if (!(el.classList.contains('hidden'))) el.classList.add('hidden');
        });
    },
    changeBlock:function(id_block){

        this.current_page = id_block;
        localStorage.setItem('current_page',id_block);

        this.hideBlocks();
        this.showBlock(id_block);

    },
}
