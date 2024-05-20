function makeArrayOfInputElement(){


        let inputClassName+'_array' = [] // contain all the account ids


if ($('.' + inputClassName+'_array'  ).length == 0) {
    $('#journal_entry_form').prepend(
        `<input type="hidden" name=${inputClassName+'_array'}   id=${inputClassName+'_array'}   class=${inputClassName+'_array'} value=${inputClassName+'_array'}>`
    )
}
let inputClassName+'_array' +'_field' = $('.' + inputClassName+'_array');
$(inputClassName+'_array' +'_field').each(function (key, value) {
    // console.log($(value).val());
    inputClassName+'_array'.push($(value).val())
})
$('#'+inputClassName+'_array' ).val(inputClassName+'_array')

}




// account ids start 
        let accountIdsArray = [] // contain all the account ids


if ($('.account_ids_array').length == 0) {
    $('#journal_entry_form').prepend(
        `<input type="hidden" name="account_ids_array" id="account_ids_array" class="account_ids_array" value=${accountIdsArray}>`
    )
}
let accountArray = $('.account_id');
$(accountArray).each(function (key, value) {
    // console.log($(value).val());
    accountIdsArray.push($(value).val())
})
$('#account_ids_array').val(accountIdsArray)
// account ids end
