$( document ).ready(function() {
    rebuildTableIndex(1)
    let configTabIdx = atob(param_on_script)
    configTabIdx = JSON.parse(configTabIdx)
    configTabIdx = configTabIdx.table_list
    $('#'+configTabIdx.table_id+' .other-tools .selected-trigger').remove()
});

getConditionTableIndex = (identity) => {
    let decode_param = atob(param_on_script)
    decode_param = JSON.parse(decode_param)
    let configTabIdx = decode_param.table_list
    let condition = {}
    $.each(configTabIdx.data_set, function(idx,data){
        condition[data.field] = $('#'+identity+' [name=search_'+data.field+']').val()
    })
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
            $.each(t_config.data_set, function(c_idx,c_coll){ 
                if (c_coll.field == 'tools') {
                    let decode_data = JSON.stringify(row)
                    decode_data = btoa(decode_data)
                    render_row += '<td>'
                    render_row += '<button class="btn btn-outline-info" onclick="editFormPelanggan(\''+decode_data+'\')">Edit</button>'
                    render_row += ' <button class="btn btn-outline-danger" onclick="deletePelanggan('+row.id_pelanggan+')">Hapus</button>'
                    render_row += '</td>'
                }else{ render_row += '<td>'+row[c_coll.field]+'</td>' }
            })
            render_row += '</tr>'
            $('#'+identity+' table tbody').append(render_row)
        })
    }
}

clearFormPelanggan = () => {
    let elmForm = $('#formPelanggan form')
    elmForm.find('[name=id_pelanggan]').val(null)
    elmForm.find('[name=username]').val(null).attr('required',false).attr('readonly',true)
    elmForm.find('[name=nama]').val(null).attr('required',false).attr('readonly',true)
    elmForm.find('[name=noalat]').val(null).attr('required',false).attr('readonly',true)
    elmForm.find('[name=daya]').val(null).attr('required',false).attr('readonly',true)
    elmForm.find('[name=alamat]').val(null).attr('required',false).attr('readonly',true)
    $('#formPelanggan').hide()
}

openFormPelanggan = () => {
    clearFormPelanggan()
    let elmForm = $('#formPelanggan form')
    elmForm.find('[name=id_pelanggan]').val(null)
    elmForm.find('[name=username]').val(null).attr('readonly',false).attr('required',true)
    elmForm.find('[name=nama]').val(null).attr('readonly',false).attr('required',true)
    elmForm.find('[name=noalat]').val(null).attr('readonly',false).attr('required',true)
    elmForm.find('[name=daya]').val(null).attr('readonly',false).attr('required',true)
    elmForm.find('[name=alamat]').val(null).attr('readonly',false).attr('required',true)
    $('#formPelanggan').show()
}

editFormPelanggan = (data) => {
    openFormPelanggan()
    let decode_data = atob(data)
    decode_data = JSON.parse(decode_data)
    let elmForm = $('#formPelanggan form')
    elmForm.find('[name=id_pelanggan]').val(decode_data.id_pelanggan)
    elmForm.find('[name=username]').val(decode_data.username)
    elmForm.find('[name=nama]').val(decode_data.nama_pelanggan)
    elmForm.find('[name=noalat]').val(decode_data.nomor_kwh)
    elmForm.find('[name=daya]').val(decode_data.id_tarif)
    elmForm.find('[name=alamat]').val(decode_data.alamat)
}

addPelanggan = () => { openFormPelanggan() }

submitFormPelanggan = () => {
    let input = {}
    let elmForm = $('#formPelanggan form')
    input.id_pelanggan = elmForm.find('[name=id_pelanggan]').val()
    input.username = elmForm.find('[name=username]').val()
    input.nama_pelanggan = elmForm.find('[name=nama]').val()
    input.nomor_kwh = elmForm.find('[name=noalat]').val()
    input.id_tarif = elmForm.find('[name=daya]').val()
    input.alamat = elmForm.find('[name=alamat]').val()

    let param = {}
    param.data = input
    param.mode = 'storePelanggan'
    param.configure = 'pelanggan'
    httpRequest('http_request.php','post',param).then(function(result){
        clearFormPelanggan()
        alert(result.msg)
        rebuildTableIndex(1)
    })
    return false
}

deletePelanggan = (idPel) => {
    let param = {}
    param.id_pelanggan = idPel
    param.mode = 'deletePelanggan'
    param.configure = 'pelanggan'
    httpRequest('http_request.php','post',param).then(function(result){
        alert(result.msg)
        rebuildTableIndex(1)
    })
}