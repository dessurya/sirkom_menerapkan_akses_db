$( document ).ready(function() {
    rebuildTableIndex(1)
    let configTabIdx = atob(param_on_script)
    configTabIdx = JSON.parse(configTabIdx)
    configTabIdx = configTabIdx.table_list
    $('#'+configTabIdx.table_id+' .other-tools').remove()
});

getConditionTableIndex = (identity) => {
    let decode_param = atob(param_on_script)
    decode_param = JSON.parse(decode_param)
    let configTabIdx = decode_param.table_list
    let condition = {}
    $.each(configTabIdx.data_set, function(idx,data){
        condition[data.field] = $('#'+identity+' [name=search_'+data.field+']').val()
    })
    condition['id_pelanggan'] = decode_param.id_pelanggan
    return condition
}

renderedTableIndex = (identity,result_data) => {
    console.log({identity,result_data})
    let decode_param = atob(param_on_script)
    decode_param = JSON.parse(decode_param)
    let t_config = decode_param.table_list

    $('#'+identity+' table tbody').html('')
    if (result_data.length == 0) {
        $('#'+identity+' table tbody').html('<tr><td class="text-center" colspan="'+t_config.data_field_count+'">-- No Data Found --</td></tr>')
    }else{
        $.each(result_data, function(idx,row){
            let render_row = '<tr>'
            $.each(t_config.data_set, function(c_idx,c_coll){ render_row += '<td>'+row[c_coll.field]+'</td>' })
            render_row += '</tr>'
            $('#'+identity+' table tbody').append(render_row)
        })
    }
}