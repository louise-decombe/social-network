function CreateForm(label,type,value,accept){
    return`<div class="text-center" >
                <label class="form-label " for='files' >${label}</label>
                <input class="form-control w-75 m-auto" id="files" type=${type} name="files" accept=${accept} >
                <input id="type_media" type="hidden" name="type" value=${value} >
           </div>
           `;
}
function CreateFormUrl(){
    return` <div class="text-center" >
                <label class="form-label " for='files' >Votre url</label>
                <input class="form-control w-75 m-auto " id="files" type='url' name="files" placeholder=' www.exemple.fr'  >
                <input id="type_media" type="hidden" name="type" value='url' >
            </div>
           `;
}