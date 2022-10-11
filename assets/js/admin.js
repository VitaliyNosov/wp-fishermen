const makersPage = document.getElementById('makers-page');
if(makersPage){

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
};

let makersObj = {};

const setDataButton = document.getElementById('set-data-button');
const allMakers = document.querySelectorAll('.maker');

const heightManualInput = document.getElementById('container-height-manual-input');
const makersContainerHeight = document.getElementById('makers_container_height');
const makersContainerHeightTablet = document.getElementById('makers_container_height_tablet');
const makersContainerHeightMobile = document.getElementById('makers_container_height_mobile');
const switchButtons = document.querySelectorAll('.makers-switch-button');

const dataPosition = document.getElementById('makers_position_number');
const dataPositionValue = dataPosition.value;
const makersTabletPositions = document.getElementById('makers_tablet_positions');
const makersTabletPositionsValue = makersTabletPositions.value;
const makersMobilePositions = document.getElementById('makers_mobile_positions');
const makersMobilePositionsValue = makersMobilePositions.value;

let makersContainerHeightValue = makersContainerHeight.value;
if (makersContainerHeightValue){
    heightManualInput.value = makersContainerHeightValue;
}

let makersDataJSON = {};
let makersDataParsed = '';
if (dataPositionValue){
    makersDataJSON = dataPositionValue;
    if(isJson(dataPositionValue)){
        makersDataParsed = JSON.parse(makersDataJSON);
        makersObj = makersDataParsed;
    }
}

function toInitialPositions(elem, id, data){
    let elemID = String(id);
    let elemObj = data[''+elemID+''];
    if (elemObj){

        let setX = elemObj.x;
        let setY = elemObj.y;
        let setIndex = elemObj.index;
        let setTextPosition = elemObj.textpos;

        elem.dataset.index = setIndex;
        elem.dataset.textPosition = setTextPosition;

        elem.style.zIndex = setIndex;

        gsap.to(
            elem, { 
                top: setY, 
                left: setX,
            }
        );
    }
}

heightManualInput.addEventListener('input', function(){
    makersPage.style.height = this.value+'px';
});

function clearSwitchButtons(arr){
    arr.forEach((e)=>{
        let data = e.dataset.site;
        makersPage.classList.remove(data);
        e.classList.remove('button-primary');
    })
}

function setSizesOnSwitch(arr, size){
    arr.forEach((e) => {

        let thumb = e.querySelector('.maker-thumb');

        let wWide = e.dataset.width;
        let hWide = e.dataset.height;

        let wTablet = e.dataset.widthTablet;
        let hTablet = e.dataset.heightTablet;

        let wMobile = e.dataset.widthMobile;
        let hMobile = e.dataset.heightMobile;

        if (size === 'wide'){
            thumb.style.width = wWide+'px';
            thumb.style.height = hWide+'px';
        }

        if (size === 'tablet'){
            thumb.style.width = wTablet+'px';
            thumb.style.height = hTablet+'px';
        }

        if (size === 'mobile'){
            thumb.style.width = wMobile+'px';
            thumb.style.height = hMobile+'px';
        }

    })
}

for(let i = 0; i < switchButtons.length; i++){
    let button = switchButtons[i];
    button.addEventListener('click', function(){

        clearSwitchButtons(switchButtons);
        let data = this.dataset.site;
        let makersDataParsed = '';

        if (data == 'wide'){
            if (dataPositionValue){
                makersDataJSON = dataPositionValue;
                if(isJson(dataPositionValue)){
                    makersDataParsed = JSON.parse(makersDataJSON);
                }
            }

            let makersContainerHeightValue = makersContainerHeight.value;
            if (makersContainerHeightValue){
                heightManualInput.value = makersContainerHeightValue;
                makersPage.style.height = heightManualInput.value+'px';
            }

            setSizesOnSwitch(allMakers, data);

        }
        if (data == 'tablet'){
            if (makersTabletPositionsValue){
                makersDataJSON = makersTabletPositionsValue;
                if(isJson(makersTabletPositionsValue)){
                    makersDataParsed = JSON.parse(makersDataJSON);
                }
            }
            let makersContainerHeightTabletValue = makersContainerHeightTablet.value;
            if (makersContainerHeightTabletValue){
                heightManualInput.value = makersContainerHeightTabletValue;
                makersPage.style.height = heightManualInput.value+'px';
            }

            setSizesOnSwitch(allMakers, data);
        }
        if (data == 'mobile'){
            if (makersMobilePositionsValue){
                makersDataJSON = makersMobilePositionsValue;
                if(isJson(makersMobilePositionsValue)){
                    makersDataParsed = JSON.parse(makersDataJSON);
                }
            }
            let makersContainerHeightMobileValue = makersContainerHeightMobile.value;
            if (makersContainerHeightMobileValue){
                heightManualInput.value = makersContainerHeightMobileValue;
                makersPage.style.height = heightManualInput.value+'px';
            }

            setSizesOnSwitch(allMakers, data);
        }

        allMakers.forEach( (e) => {
            let id =  String(e.id);
            toInitialPositions(e, id, makersDataParsed);
        });

        makersPage.classList.add(data);
        this.classList.add('button-primary');

    });
}

function getDataOnSetButton(elem){

    let id = elem.id;
    let x = elem.style.left;
    let y = elem.style.top;

    let thumb = elem.querySelector('.maker-thumb');
    let width = thumb.style.width;
    let height = thumb.style.height;
    let zIndex = elem.dataset.index;
    let textPosition = elem.dataset.textPosition;

    makersObj[id] = {
        'id': id,
        'x': x,
        'y': y,
        'width': width,
        'height': height, 
        'index': zIndex,
        'textpos': textPosition,
    }
}

gsap.utils.toArray('.maker').forEach(function(elem){

    let elemID = String(elem.id);
    toInitialPositions(elem, elemID, makersDataParsed);

    let indexButtonUp = elem.querySelector('.maker-action-index-up');
    indexButtonUp.addEventListener('click', function(){
        let dataIndex = elem.dataset.index;
        dataIndex = Number(dataIndex) + 1; 
        elem.dataset.index = dataIndex;
        elem.style.zIndex = dataIndex; 
    });
    let indexButtonDown = elem.querySelector('.maker-action-index-down');
    indexButtonDown.addEventListener('click', function(){
        let dataIndex = elem.dataset.index;
        dataIndex = Number(dataIndex) - 1; 
        if(dataIndex <= 0){
            elem.dataset.index = '1';
            elem.style.zIndex = '1'; 
            return;
        }
        elem.dataset.index = dataIndex;
        elem.style.zIndex = dataIndex; 
    });

    let textPositionButton = elem.querySelector('.maker-action-text-position');
    textPositionButton.addEventListener('click', function(){

        console.log('asd');

        let dataTextPosition = elem.dataset.textPosition;
        if (dataTextPosition === 'left'){
            elem.dataset.textPosition = 'right';
        }
        if (dataTextPosition === 'right'){
            elem.dataset.textPosition = 'left';
        }
    });

    const draggable = Draggable.create(
        elem, 
        {
            type: "left,top", 
            edgeResistance: 1, 
            bounds: "#makers-page",
        }
    );
});

setDataButton.addEventListener('click', function(){

    gsap.utils.toArray('.maker').forEach(function(elem){
        getDataOnSetButton(elem);
    });

    let contaiherHeight = heightManualInput.value;
    let dataMakersJSON = JSON.stringify(makersObj);

    console.log(dataMakersJSON);

    if (makersPage.classList.contains('wide')){
        makersContainerHeight.value = contaiherHeight;
        dataPosition.value = '';
        dataPosition.value = dataMakersJSON;
    }
    if (makersPage.classList.contains('tablet')){
        makersContainerHeightTablet.value = contaiherHeight;
        makersTabletPositions.value = '';
        makersTabletPositions.value = dataMakersJSON;
    }
    if (makersPage.classList.contains('mobile')){
        makersContainerHeightMobile.value = contaiherHeight;
        makersMobilePositions.value = '';
        makersMobilePositions.value = dataMakersJSON;
    }

});

}