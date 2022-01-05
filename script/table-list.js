selectAllRowTable = (target, param) => {
    var selection = $("#"+target+" table tbody tr");
    if (param == true) { selection.addClass("selected") }
    else if (param == false) { selection.removeClass("selected") }
}

rebuildTableIndex = async (page) => {
    let configTabIdx = atob(param_on_script)
    configTabIdx = JSON.parse(configTabIdx)
    configTabIdx = configTabIdx.table_list
    
    let target = configTabIdx.table_http.url
    let identity = configTabIdx.table_id
    let httpConfigMode = configTabIdx.table_http.mode
    let httpConfig = configTabIdx.table_http.configure

    loadingScreen(true)
    let param = {}
    param['mode'] = httpConfigMode
    param['configure'] = httpConfig
    param['show'] = $('#'+identity+' [name=show]').val()
    param['order_key'] = $('#'+identity+' [name=order_key]').val()
    param['order_val'] = $('#'+identity+' [name=order_val]').val()
    param['page'] = page
    if (page == null) { param['page'] = $('#'+identity+' [name=page]').val() }
    param['condition'] = getConditionTableIndex(identity)
    try {
        let result_data = await httpRequest(target,'post',param).then(function(result){
            loadingScreen(false)
            return result
        })
        console.log(result_data)
        $('#'+identity+' .tabel-info #from').html(result_data.data.from);
        $('#'+identity+' .tabel-info #to').html(result_data.data.to);
        $('#'+identity+' .tabel-info #total').html(result_data.data.total);
        $('#'+identity+' .tabel-info #last_page').html(result_data.data.last_page);
        $('#'+identity+' .tabel-info input[name=page]').attr('max', result_data.data.last_page);
        $('#'+identity+' .tabel-info input[name=page]').val(result_data.data.current_page);
        renderedTableIndex(identity,result_data.data.data)
    } catch (error) {
        console.log(error)
        loadingScreen(false)
    }
}