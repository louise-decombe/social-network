function CreateForm(type,value,accept){
    return`<input id="files" type=${type} name="files" accept=${accept} >
           <input id="type_media" type="hidden" name="type" value=${value} >
           `;
}
function CreateFormUrl(){
    return`<input id="files" type='url' name="files"  >
           <input id="type_media" type="hidden" name="type" value='url'  >
           `;
}