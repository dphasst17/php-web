<div class="product w-full h-auto min-h-[600px] flex flex-col lg:justify-evenly mb-[2%]">
    <div class="filter w-[350px] lg:w-2/4 h-auto min-h-[100px] relative flex flex-wrap flex-row justify-start items-center rounded-[10px]" >
        <div 
            class="w-[100px] h-[30px] mx-[3%]  flex flex-row items-center justify-evenly text-[20px] rounded-[5px] border-solid border-black border-[1px] font-semibold border-b-solid border-b-black border-b-[1px] cursor-pointer"
            onclick="handleShowHide(getFilter,svgType)">
            Type 
            <svg id="svgType" class="h-[85%] flex items-center justify-center transition-all" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
            </svg>
            
        </div>
        <div class="filterDetail w-[250px] absolute top-[100px] md:top-[80px] left-[10px] md:left-[10px] bg-slate-300 flex flex-wrap justify-center items-center rounded-[10px]" style="height:0px;overflow:hidden; transition:all .2s linear" id="getFilter">
        </div>

        <div class="w-[100px] h-[30px] mx-[3%] flex flex-row items-center justify-evenly text-[20px] rounded-[5px] border-solid border-black border-[1px] font-semibold border-b-solid border-b-black border-b-[1px] cursor-pointer" 
             onclick="handleShowHide(getFilter2,svgBrand)">
             Brand
             <svg id="svgBrand" class="h-[85%] flex items-center justify-center transition-all" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
            </svg>
        </div>
        <div class="filter w-[250px] absolute top-[100px] md:top-[80px] left-[10px] md:left-[100px] bg-slate-300 flex flex-wrap justify-center items-center rounded-[10px]" style="height:0px;overflow-y:scroll;overflow-x:hidden; transition:all .2s linear" id="getFilter2">
        </div>

        <div class="w-[100px] h-[30px] mx-[3%] flex flex-row items-center justify-evenly text-[20px] rounded-[5px] border-solid border-black border-[1px] font-semibold border-b-solid border-b-black border-b-[1px] cursor-pointer" 
            onclick="handleShowHide(selectOption,svgOption)">
            Option
            <svg id="svgOption" class="h-[85%] flex items-center justify-center transition-all" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
            </svg>
        </div>
        <div class="filter w-[250px] absolute top-[100px] md:top-[80px] left-[10px] md:left-[190px] bg-slate-300 h-auto flex flex-wrap justify-evenly items-center rounded-[10px]" id="selectOption" style="height:0px;overflow-y:scroll;overflow-x:hidden; transition:all .2s linear">
        </div>
        
    </div>
    <div class="viewProduct w-full h-auto min-h-[200px] flex flex-col items-center mb-[2%]">
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
    fetch('./api/products')
    .then(res => {
        if (!res.ok) {
            throw new Error(`An error occurred: ${res.status}`);
        }
        return res.json();
    })
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
            document.getElementById("selectOption").appendChild(fieldset);

            const legend = document.createElement("div");
            legend.textContent = resultDetail[i];
            legend.setAttribute("class", "w-[125px] text-[20px] font-semibold overflow-hidden whitespace-nowrap text-ellipsis cursor-pointer");
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
    .catch(error => {
        console.log(error);
    });
</script>
<script src="/public/js/getProduct.js"></script>