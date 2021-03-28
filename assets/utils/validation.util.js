export const textValidation = (params,val) =>{
    const min = params.min ? params.min : 2;
    const max = params.max ? params.max : 255;
    const newVal = val.trim();

    if(newVal === ''){
        return 'Dit tekst vak mag niet leeg blijven.';
    }

    if(newVal.length < min  || newVal.length > max ){
        return 'Uw invoer komt niet overeen met onze criteria. ';
    }

    return '';
}

export const emailValidation = (params,val) =>{
    const newVal = val.trim();
    const emailRegex = /^([A-Za-z0-9_\-.+])+@([A-Za-z0-9_\-.])+\.([A-Za-z]{2,})$/;

    textValidation({}, val);

    if(!emailRegex.test(newVal)){
        return 'Voer een geldige email in';
    }
    return '';
}