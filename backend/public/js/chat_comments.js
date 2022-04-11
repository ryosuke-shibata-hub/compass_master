$(function() {
    get_data();
});

function get_data() {
    $.ajax({
        url: "/chat/result/ajax",
        dataType: "json",
        success: data => {
            console.log(data);
        },
        error: () => {
            alert("ajax Error");
        }
    });

    setTimeout("get_data()", 5000);
}
