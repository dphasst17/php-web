
<div class="product w-full h-auto min-h-[600px] flex lg:justify-evenly my-[2%]">
    <div class="filter w-1/5 h-[15%] hidden lg:flex flex-wrap justify-start items-start rounded-[10px] bg-slate-100" >
        <h1 class="w-full h-[30px] pl-[6%] text-[20px] font-semibold border-b-solid border-b-black border-b-[1px] cursor-pointer" onclick="handleShowHide(getFilter)">Filter with Type</h1>
        <div class="filterDetail w-full flex flex-wrap justify-center items-center rounded-[10px] transition-all" style="height:auto;overflow:hidden;transition:height .5s linear" id="getFilter">
            
        </div>
        <h1 class="w-full h-[30px] pl-[6%] text-[20px] font-semibold border-b-solid border-b-black border-b-[1px] cursor-pointer" onclick="handleShowHide(getFilter2)">Filter with Brand</h1>
        <div class="filter w-full flex flex-wrap justify-center items-center rounded-[10px] transition-all" style="height:0px;overflow:hidden;transition:height .5s linear" id="getFilter2">
           
        </div>
        <h1 class="w-full h-[30px] pl-[6%] text-[20px] font-semibold border-b-solid border-b-black border-b-[1px] cursor-pointer">Filter value Option</h1>
        <div class="filter w-full  h-auto hidden lg:flex flex-wrap justify-evenly items-center rounded-[10px]" id="selectOption">
           
        </div>
        
    </div>
    <div class="viewProduct w-full lg:w-[75%] h-auto min-h-[200px] flex flex-col items-center mb-[2%]">
        <div id="getAll" class="w-full lg:w-[95%] h-auto min-h-[700px] flex flex-wrap justify-center xl:justify-evenly items-start"></div>
        <div class="pagination w-full smr:w-4/5 h-[150px] smr:h-[50px] flex flex-col smr:flex-row justify-center items-center my-[4%] smr:my-0">
            <div class="prevPage w-[70px] h-[30px] my-[2%] smr:my-0 bg-slate-300 flex items-center justify-center text-[18px] text-black font-medium rounded-[8px] cursor-pointer transition-all hover:bg-[#586582] hover:text-white" onclick="prevPage()">PREV</div>
            <div class="buttonPage w-full smr:w-3/5 min-w-[60px] h-full flex justify-evenly items-center mx-[2%]" id="buttonPage">
            
            </div>
            <div class="nextPage w-[70px] h-[30px] my-[2%] smr:my-0 bg-slate-300 flex items-center justify-center text-[18px] text-black font-medium rounded-[8px] cursor-pointer transition-all hover:bg-[#586582] hover:text-white" onclick="nextPage()">NEXT</div>
        </div>
    </div> 
</div>



<script>
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
    
    //Get data Product------------------------------------------------------
    fetch('./api/products')
    .then(res => {
        if (!res.ok) {
            throw new Error(`An error occurred: ${res.status}`);
        }
        return res.json();
    })
    .then(pro => {
        data = pro;
        let brand = Array.from(new Set(pro.map(e => e.brand.toUpperCase())));

        let resultDetail = Array.from(new Set(pro.flatMap(e => [e.detail1, e.detail2, e.detail3, e.detail4].map(d => d.slice(0, d.indexOf(":")))))).filter(e => e !== "");
        let resultValueDetail = Array.from(new Set(pro.flatMap(e => [e.detail1, e.detail2, e.detail3, e.detail4]))).filter(e => e !== "");

        for (let i = 0; i < resultDetail.length; i++) {
            const fieldset = document.createElement("div");
            fieldset.id = resultDetail[i];
            fieldset.className = "option w-[125px] h-auto flex flex-row justify-center overflow-hidden";
            document.getElementById("selectOption").appendChild(fieldset);

            const legend = document.createElement("div");
            legend.textContent = resultDetail[i];
            legend.setAttribute("class", "w-[125px] text-[20px] font-semibold overflow-hidden whitespace-nowrap text-ellipsis cursor-pointer");
            legend.setAttribute("onclick", "handleShowHideOption('" + resultDetail[i] + "-container')");
            fieldset.appendChild(legend);

            const div = document.createElement("div");
            div.id = resultDetail[i] + "-container";
            div.className = "labelFilter absolute bg-slate-400 rounded-[5px] text-white";
            div.setAttribute("style", "width:0px;height:0px;overflow:hidden;transition:height .5s linear");
            fieldset.appendChild(div);
        }

        for (let i = 0; i < resultValueDetail.length; i++) {
            let optionValue = resultValueDetail[i].split(":")[1];
            let optionText = resultValueDetail[i].split(":")[1];
            let selectId = resultValueDetail[i].split(":")[0];

            const label = document.createElement("label");
            label.setAttribute("class", "w-4/5 flex flex-row-reverse justify-end overflow-hidden whitespace-nowrap text-ellipsis");
            document.getElementById(selectId + "-container").appendChild(label);
            
            const pTag = document.createElement("p");
            pTag.textContent = optionText;
            pTag.setAttribute("class", "w-full overflow-hidden whitespace-nowrap text-ellipsis cursor-pointer");
            label.appendChild(pTag);

            const input = document.createElement("input");
            input.type = "checkbox";
            input.value = optionValue;
            input.setAttribute("style", "order:1");
            input.setAttribute("onclick", "filterOption('"+optionText+"')");
            label.appendChild(input);
        }


        viewFilterBrand(brand)
        if(valueFilter.length === 0){viewProducts(pro,start,end);}
        totalPage = data.length % itemsInPage === 0 ? data.length / itemsInPage : (data.length / itemsInPage) + 1;
        paginationPage();
    })
    .catch(error => {
        console.log(error);
    });

    //Get data filter---------------------------------------------------------
    fetch('./api/products/type')
    .then(res => {
        if (!res.ok) {
            throw new Error(`An error occurred: ${res.status}`);
        }
        return res.json();
    })
    .then(filters => {
        viewFilter(filters)
    })
    .catch(error => {
        console.log(error);
    });


    /* Function view Filter and Product */
    const viewProducts = (p,start,end) => {
        let viewProduct = p.slice(start,end).map(e => `<div class="items w-[30%] lg:w-1/5 md:w-[230px] min-w-[150px] h-[550px] md:h-[400px] mx-[1%] cursor-pointer" key=${e.idProduct}>
            <div class="itemsImg w-full h-2/5 flex justify-center"><img class="w-full h-full object-contain" src=${e.imgProduct} alt="imgProduct"/></div>
            <div class="itemsTitle w-full h-[65px] flex justify-center items-center text-[20px] text-[#9d2b2b] font-semibold"><span class='overflow-hidden whitespace-nowrap text-ellipsis'>${e.nameProduct}</span></div>
            <div class='w-full min-h-[10%] h-auto'>
                <p class='text-blue-950 font-bold text-[17px] overflow-hidden whitespace-nowrap text-ellipsis'>${e.detail1}</p>
                <p class='text-blue-950 font-bold text-[17px] overflow-hidden whitespace-nowrap text-ellipsis'>${e.detail2}</p>
                <p class='text-blue-950 font-bold text-[17px] overflow-hidden whitespace-nowrap text-ellipsis'>${e.detail3}</p>
            </div>
            <div class="itemsPrice w-full h-[50px] flex justify-start items-center text-[20px] text-black font-semibold py-[5px]">Price: <span class="text-[20px] text-[#9d2b2b] font-semibold my-[2px]">${e.price} USD</span> </div>
            <div class="button w-full h-[150px] md:h-[50px] flex flex-col md:flex-row lg:justify-evenly">
                <button class="w-full md:w-3/5 h-[30%] md:h-[70%] rounded-[5px] outline-none cursor-pointer border-none text-[20px] text-white font-semibold bg-[#586582] hover:bg-blue-700 transition-all" onclick="addCart(${e.idProduct},'${us}')" >Add to cart</button>
                <button class="w-full md:w-1/4 h-[30%] md:h-[70%] rounded-[5px] outline-none cursor-pointer border-none font-medium hover:bg-blue-700 hover:text-white transition-all" onclick="location.href='detail/${e.idType}/${e.idProduct}/${e.nameProduct}'">Detail</button>
            </div>
        </div>`);
        document.getElementById('getAll').innerHTML = viewProduct.join('');
        paginationPage();
    }

    const viewFilter = (f) => {
        let viewFIlter = f.map(e => `<div class="inputFilter w-[45%] h-[50px] flex flex-wrap items-center pl-[2%] cursor-pointer">
            <input class="accent-[#0a65c0] rounded-[50%] cursor-pointer checked:border-indigo-50 transition-all" type="checkbox" value=${e.idType} id='filter${e.idType}' name='filter' onclick='filterType("${e.idType}")' />
            <label class="text-[#2f4466] text-[18px] font-semibold cursor-pointer" for='filter${e.idType}'>${e.nameType.toUpperCase()}</label>
        </div>`);
        document.getElementById('getFilter').innerHTML = viewFIlter.join('');
    }
    const viewFilterBrand = (f) => {
        let filterBrand = f.map(e => `<div class="inputFilter w-[45%] h-[50px] flex flex-wrap items-center pl-[2%] cursor-pointer">
            <input class="accent-[#0a65c0] rounded-[50%] cursor-pointer checked:border-indigo-50 transition-all" type="checkbox" value=${e} id='filter${e}' 
                name='filter' onclick='filterBrand("${e.toLowerCase()}")' />
            <label class="text-[#2f4466] text-[18px] font-semibold cursor-pointer" for='filter${e}'>${e.toUpperCase()}</label>
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
                filterData = data.filter(d => (valueFilter.length === 0 ? valueFilterBrand.includes(d.brand) : valueFilter.includes(d.idType)) 
                    && ['detail1', 'detail2', 'detail3', 'detail4'].some(key => valueOption.includes(d[key].slice(d[key].indexOf(":")+1))));
            }
            else{
                filterData = data.filter(d => 
                    valueFilterBrand.includes(d.brand) && valueFilter.includes(d.idType) && ['detail1', 'detail2', 'detail3', 'detail4'].some(key => 
                    valueOption.includes(d[key].slice(d[key].indexOf(":")+1)))
                );
            }
        }else{
            if (valueFilter.length === 0 && valueFilterBrand.length === 0){
                filterData = data
            }
            else if(valueFilter.length === 0 || valueFilterBrand.length === 0){
                filterData = data.filter(d => valueFilter.length === 0 ? valueFilterBrand.includes(d.brand) : valueFilter.includes(d.idType));
            }
            else{
                filterData = data.filter(d => valueFilterBrand.includes(d.brand) && valueFilter.includes(d.idType));
            }
        }
        
    }

    const filterType = (e) => {
        start = 0;
        end = 12;
        activePage = 1;
        if (!valueFilter.includes(e)) {
            valueFilter.push(e);   
        }else{
            valueFilter = valueFilter.filter(i => i !== e);
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


    const handleShowHide = (e) => {
        e.style.height === "0px" ? e.style.height = "auto" : e.style.height = "0px"
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
</script>