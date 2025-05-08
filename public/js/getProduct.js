    let us = JSON.parse(localStorage.getItem("uS") || "[]");
    let data = []
    let valueFilter = [];
    let valueFilterBrand = [];
    let valueOption = [];
    let filterData = [];
    let start = 0;
    let end = 12;
    let itemsInPage = 12;
    let activePage = 1
    let totalPage = 0;

    const viewProducts = (p,start,end) => {
        let viewProduct = p.slice(start,end).map(e => productElement(e));
        document.getElementById('getAll').innerHTML = viewProduct.join('');
        paginationPage();
    }

    const viewFilter = (f) => {
        let viewFIlter = f.map(e => `<div id="filter-${e}" class=" h-[25px] grid grid-cols-11 gap-x-2 shadow-md hover:bg-zinc-200 px-[2px] rounded-sm cursor-pointer transition-all">
            <input class="hidden accent-[#0a65c0] rounded-[50%] cursor-pointer checked:border-indigo-50 transition-all" 
                type="checkbox" value=${e} id='filter${e}' name='filter' onclick='filterType("${e}")' />
            <label class="col-span-11 text-center text-[18px] font-semibold cursor-pointer" for='filter${e}'>${e.toUpperCase()}</label>
        </div>`);
        document.getElementById('getFilter').innerHTML = viewFIlter.join('');
    }
    const viewFilterBrand = (f) => {
        let filterBrand = f.map(e => `<div class="h-[25px] grid grid-cols-10 shadow-md hover:bg-zinc-500 hover:text-white rounded-sm px-[2px] cursor-pointer my-2 transition-all">
            <input class="hidden accent-[#0a65c0] rounded-[50%] cursor-pointer checked:border-indigo-50 transition-all" type="checkbox" value=${e} id='filter${e}' 
                name='filter' onclick='filterBrand("${e.toLowerCase()}")' />
            <label class="col-span-10 text-center text-[18px] flex items-center justify-start font-semibold cursor-pointer" for='filter${e}'>
                <p class="truncate">${e.toUpperCase()}</p>
            </label>
        </div>`);
        document.getElementById('getFilter2').innerHTML = filterBrand.join('');
    }

    const nextPage = () => {
        if(activePage < totalPage){
            activePage = activePage + 1;
            setPagination(activePage)
        }
    }
    const prevPage = () => {
        if(activePage > 1){
            activePage = activePage - 1;
            setPagination(activePage)
        }
    }
    const paginationPage = () => {
        let pagination = [];
        
        for(let i = 1; i <= totalPage; i++){
            pagination.push(i);
        }
        let viewPagination = pagination.map(e => `<button class='${e === activePage ? 'activeBtn' : " "} w-[70px]smr:w-[45px] min-w-[30px] h-[70px] smr:h-[25px] text-[18px] font-medium rounded-[8px] border-none cursor-pointer hover:bg-[#586582] hover:text-white' onclick='setPagination(${e})' id="showButton-${e}">${e}</button>`);
        document.getElementById('buttonPage').innerHTML = viewPagination.join('')
    }
    const setPagination = (e) => {
        start = (12 * e) - 12;
        end = 12*e;
        document.getElementById(`showButton-${activePage}`).classList.remove('active');
        activePage = e;
        document.getElementById(`showButton-${e}`).classList.add('active');
        checkFilter();
        viewProducts(filterData, start, end);
    }
    
    const checkFilter = () => {
        if(valueOption.length !== 0){
            if(valueFilter.length === 0 && valueFilterBrand.length === 0){
                filterData = data.filter(d => ['detail1', 'detail2', 'detail3', 'detail4'].some(key => 
                    valueOption.includes(d[key].slice(d[key].indexOf(":")+1))))
            }
            else if(valueFilter.length === 0 || valueFilterBrand.length === 0){
                filterData = data.filter(d => (valueFilter.length === 0 ? valueFilterBrand.includes(d.brand) : valueFilter.includes(d.nameType)) 
                    && ['detail1', 'detail2', 'detail3', 'detail4'].some(key => valueOption.includes(d[key].slice(d[key].indexOf(":")+1))));
            }
            else{
                filterData = data.filter(d => 
                    valueFilterBrand.includes(d.brand) && valueFilter.includes(d.nameType) && ['detail1', 'detail2', 'detail3', 'detail4'].some(key => 
                    valueOption.includes(d[key].slice(d[key].indexOf(":")+1)))
                );
            }
        }else{
            if (valueFilter.length === 0 && valueFilterBrand.length === 0){
                filterData = data
            }
            else if(valueFilter.length === 0 || valueFilterBrand.length === 0){
                filterData = data.filter(d => valueFilter.length === 0 ? valueFilterBrand.includes(d.brand) : valueFilter.includes(d.nameType));
            }
            else{
                filterData = data.filter(d => valueFilterBrand.includes(d.brand) && valueFilter.includes(d.nameType));
            }
        }
    }

    const filterType = (e) => {
        start = 0;
        end = 12;
        activePage = 1;
        if (!valueFilter.includes(e)) {
            valueFilter.push(e);
            document.getElementById(`filter-${e}`).classList.add('bg-zinc-500');
            document.getElementById(`filter-${e}`).classList.add('text-white');
        }else{
            valueFilter = valueFilter.filter(i => i !== e);
            document.getElementById(`filter-${e}`).classList.remove('bg-zinc-500');
            document.getElementById(`filter-${e}`).classList.remove('text-white');
        }
        checkFilter()
        totalPage = filterData.length % itemsInPage === 0 ? filterData.length / itemsInPage : (filterData.length / itemsInPage) + 1;
        viewProducts(filterData, start, end);
        
    };
    const filterBrand = (e) => {
        start = 0;
        end = 12;
        activePage = 1;
        if (!valueFilterBrand.includes(e)) {
            valueFilterBrand.push(e);
        }else{
            valueFilterBrand = valueFilterBrand.filter(i => i !== e);
        }
        checkFilter();
        totalPage = filterData.length % itemsInPage === 0 ? filterData.length / itemsInPage : (filterData.length / itemsInPage) + 1;
        viewProducts(filterData, start, end);
    }
    const filterOption = (e) => {
        start = 0
        end = 12
        activePage = 1;
        if (!valueOption.includes(e)) {
            valueOption.push(e);
        }else{
            valueOption = valueOption.filter(i => i !== e);
        }  
        checkFilter()
        totalPage = filterData.length % itemsInPage === 0 ? filterData.length / itemsInPage : (filterData.length / itemsInPage) + 1;
        viewProducts(filterData, start, end);
    }


    const handleShowHide = (e,svg) => {
        if(e.style.height === "0px"){
            e.style.height = "200px"
            svg.style.transform = "rotate(45deg)"

        }else{
            e.style.height = "0px"
            svg.style.transform = "rotate(0deg)"
        } 
    }
    const handleShowHideOption = (e) => {
        const getIdOption = document.getElementById(e);
        let div = document.querySelectorAll('.labelFilter');
        for (var i = 0; i < div.length; i++) {
          if (div[i] !== getIdOption && div[i].style.height === 'auto') {
            div[i].style.height = '0px';
          }
        }
        if (getIdOption.style.height === 'auto') {
            getIdOption.style.height = '0px';
            getIdOption.style.width = '0px';
        } else {
            getIdOption.style.height = 'auto';
            getIdOption.style.width = '200px';
            getIdOption.style.margin = '2% 0% 0% 5%';
        }
    }