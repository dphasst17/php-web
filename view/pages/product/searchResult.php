<div class="product w-full h-auto min-h-[600px] grid grid-cols-1 lg:grid-cols-10 p-4">
    <div class="hidden lg:block filter col-span-2 h-full flex flex-col items-start justify-start rounded-[10px]" >
        <div class="w-4/5  grid grid-cols-2 content-start gap-4 rounded-[10px] my-2 pt-10" 
            style="overflow:hidden; transition:all .2s linear" id="getFilter2">
        </div>
    </div>
    <div class="viewProduct col-span-8 h-auto min-h-[200px] grid grid-cols-1 grid-rows-12 p-1 lg:p-4">
        <div class="w-full row-span-1 grid grid-cols-3 md:grid-cols-6 lg:grid-cols-10 content-center gap-4 px-2" 
            style="overflow:hidden; transition:all .2s linear" id="getFilter">
        </div>
        <div id="getAll" class="row-span-10 grid grid-cols-1 ssm:grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6"></div>
        <div class="pagination row-span-1 flex flex-col smr:flex-row justify-center items-center my-[4%] smr:my-0">
            <div class="prevPage w-[70px] h-[30px] my-[2%] smr:my-0 bg-slate-300 flex items-center justify-center text-[18px] text-black font-medium rounded-[8px] cursor-pointer transition-all hover:bg-[#586582] hover:text-white" onclick="prevPage()">PREV</div>
            <div class="buttonPage w-full smr:w-3/5 min-w-[60px] h-full flex justify-evenly items-center mx-[2%]" id="buttonPage">
            
            </div>
            <div class="nextPage w-[70px] h-[30px] my-[2%] smr:my-0 bg-slate-300 flex items-center justify-center text-[18px] text-black font-medium rounded-[8px] cursor-pointer transition-all hover:bg-[#586582] hover:text-white" onclick="nextPage()">NEXT</div>
        </div>
    </div> 
</div>

<script>
    let value = window.location.pathname.split( '/search/' );
    /* Get Result from Api */
    fetch(`/api/products/search/${value[1]}`)
    .then(res => {return res.json()})
    .then(resultData => {
        data = resultData;
        let brand = Array.from(new Set(resultData.map(e => e.brand.toUpperCase())));
        let type = Array.from(new Set(resultData.flatMap(e =>e.nameType)))
        let resultDetail = Array.from(new Set(resultData.flatMap(e => [e.detail1, e.detail2, e.detail3, e.detail4].map(d => d.slice(0, d.indexOf(":")))))).filter(e => e !== "");
        let resultValueDetail = Array.from(new Set(resultData.flatMap(e => [e.detail1, e.detail2, e.detail3, e.detail4]))).filter(e => e !== "");

        for (let i = 0; i < resultDetail.length; i++) {
            const fieldset = document.createElement("div");
            fieldset.id = resultDetail[i];
            fieldset.className = "option w-full h-auto flex flex-col justify-center pl-[2%] overflow-hidden";

            const legend = document.createElement("div");
            legend.textContent = resultDetail[i];
            legend.setAttribute("class", "w-[125px] h-[200px] text-[20px] font-semibold overflow-hidden whitespace-nowrap text-ellipsis cursor-pointer");
            legend.setAttribute("onclick", "handleShowHideOption('" + resultDetail[i] + "-container')");
            fieldset.appendChild(legend);

            const div = document.createElement("div");
            div.id = resultDetail[i] + "-container";
            div.className = "labelFilter bg-slate-400 rounded-[5px] text-white";
            div.setAttribute("style", "width:0px;height:0px;overflow:hidden;transition:height .5s linear");
            fieldset.appendChild(div);
        }

        for (let i = 0; i < resultValueDetail.length; i++) {
            let optionValue = resultValueDetail[i].split(":")[1];
            let optionText = resultValueDetail[i].split(":")[1];
            let selectId = resultValueDetail[i].split(":")[0];

            const label = document.createElement("label");
            label.setAttribute("class", "w-4/5 flex flex-row-reverse justify-end overflow-hidden whitespace-nowrap text-ellipsis");
            
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
        if(type.length !== 0 ){
            viewFilter(type)
        }
        if(brand.length !== 0 ){
            viewFilterBrand(brand)
        }
        if(valueFilter.length === 0){viewProducts(resultData,start,end);}
        totalPage = data.length % itemsInPage === 0 ? data.length / itemsInPage : (data.length / itemsInPage) + 1;
        paginationPage();
    })

</script>
<script src="/public/js/getProduct.js"></script>