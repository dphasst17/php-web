const handleHideShowAdmin = (e) => {
    const items = document.getElementById(e)
    if(items.style.width === "0px"){
        items.style.width = "100px"
        items.style.height = "50px"
    }else{
        items.style.width = "0px"
        items.style.height = "0px"
    }
    
}
/* ------Handle Pagination for Admin -------------*/
const paginationPage = (idTitle,fView) => {
    let pagination = [];
    for(let i = 1; i <= totalPage; i++){
        pagination.push(i);
    }
    let viewPagination = pagination.map(e => `<button class='w-[50px] h-[50px] text-white text-[15px] mx-[1%] ${e === activePage ? 'text-[20px] bg-blue-600 font-bold' : ''}hover:bg-blue-600 hover:font-bold rounded-[5px] transition-all' 
        onclick='setPagination(${e},"${idTitle}",${fView})' id="${idTitle}-${e}">${e}</button>`);
    document.getElementById('buttonPage').innerHTML = viewPagination.join('')
}
const setPagination = (e,idBtn,fView) => {
    start = (12 * e) - 12;
    end = 12*e;
    document.getElementById(`${idBtn}-${activePage}`).classList.remove('active');
    activePage = e;
    document.getElementById(`${idBtn}-${e}`).classList.add('active');
    fView(data,start,end);
}