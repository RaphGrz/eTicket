function selection() {
    id = $('#keywords').val();
    keyword = $("select#keywords option").filter(":selected").text();
    $("select#keywords option").filter(":selected").hide();
    $("#keywords").val(-1);
    $("#keywordsList").append("<span id=\"keyword_" + id + "\">" +
                              "<input type=\"hidden\" value=\"" + id + "\" name=\"keywords[" + id + "]\" />" +
                              "<span class=\"badge bg-primary m-1\">"+
                              "<span class=\"align-middle pe-2\">" + keyword + "</span>" +
                              "<span class=\"align-top\">" +
                              "<button type=\"button\" class=\"btn-close\" onclick=\"javascript:deletekeyword(" + id + ")\"></button>" +
                              "</span>" +
                              "</span></span>");
}
function deletekeyword(id) {
    $("option[value=" + id + "]").show();
    $('#keyword_' + id).remove();
}