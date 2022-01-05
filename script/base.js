loadingScreen = (show) => { // function not use
    // if (show == true) { $('#loading-page').fadeIn() }
    // else { $('#loading-page').fadeOut() }
}

toogleClass = (param, target) => {
    $(target).toggleClass(param)
}

httpRequest = (target, method, param) => {
    return new Promise(function(resolve, reject) {
        $.ajax({
            url: target,
            type: method,
            data: param,
            dataType: 'json',
            success : function(result) { resolve(result) },
            error : function(err) { reject(err) }
        })
    })
}