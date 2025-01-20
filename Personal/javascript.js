function OpenUrl(dataArray) {

    var url = null;
    var data = null;
    var type = "POST";
    var result = "resultDiv";
    var complete = null;

    if( dataArray["Url"] != undefined )
        url = dataArray["Url"];

    if( dataArray["Data"] != undefined )
        data = dataArray["Data"];

    if( dataArray["Type"] != undefined )
        type = dataArray["Type"];

    if( dataArray["Result"] != undefined )
        result = dataArray["Result"];

    if( dataArray["Complete"] != undefined )
        complete = dataArray["Complete"];

    $.ajax({
        url: url,
        data: data,
        type: type,
        success: function(res) {
            $(result).html(res);
        },
        complete:function (){
            eval(complete);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching content:', status, error);
            $('#main-content').html('<p>Error loading content.</p>');
            alert(error);
        }
    });
}




function OpenEmployeesPage() {
    OpenUrl({Url: "employees/index.php", Result: ".container", Complete: "OpenEmployeesTable();"});
}
function OpenEmployeesForm(EmployeeId) {
    OpenUrl({Url: "employees/form.php", Data: "EmployeeId=" + EmployeeId , Result: "#cntn", Complete: "//OpenEmployeesTable();"});
}
function OpenEmployeesTable() {
    OpenUrl({Url: "employees/table.php", Data: $("#calisan_table").serialize(), Result: "#cntn"});
}
function SaveEmployeesModul() {
    OpenUrl({Url: "employees/save.php", Data: $("#store").serialize(), Result: ".container", Complete: "OpenEmployeesForm(-1);"});
}
function RemoveEmployeesTable(delete_id) {
    OpenUrl({Url: "employees/delete.php", Data: "delete_id=" + delete_id, Complete: "OpenEmployeesTable();" });
}
function UpdateEmployee() {
    OpenUrl({ Url: "employees/düzenle.php", Data: $("#editForm").serialize(), Result: "#cntn", Complete: "//OpenEmployeesTable();" });
}
function OpenEmployeesEdit(EmployeeId) {
    OpenUrl({ Url: "employees/duzenle_form.php", Data: "edit_id=" + EmployeeId, Result: "#cntn" });
}









function OpenExaminationPage() {
    OpenUrl({Url: "examination/index.php", Result: ".container", Complete: "OpenExaminationForm(-1);"});
}
function OpenExaminationForm(ExaminationId) {
    OpenUrl({Url: "examination/form.php", Data: "ExaminationId=" + ExaminationId , Result: "#frmExaminationDiv", Complete: "OpenExaminationTable();"});
}
function OpenExaminationTable() {
    OpenUrl({Url: "examination/table.php", Data: $("#muayene_table").serialize(), Result: "#tblExaminationDiv"});
}
function SaveExaminationModul() {
    OpenUrl({Url: "examination/save.php", Data: $("#store").serialize(), Result: ".container", Complete: "OpenExaminationForm(-1);"});
}
function RemoveExaminationTable(delete_id) {
    OpenUrl({Url: "examination/delete.php", Data: "delete_id=" + delete_id, Complete: "OpenExaminationForm(-1);" });
}
function UpdateExamination() {
    OpenUrl({ Url: "examination/duzenle.php", Data: $("#editForm").serialize(), Complete: "OpenExaminationTable();" });
}
function OpenExaminationEdit(ExaminationId) {
    OpenUrl({ Url: "examination/duzenle_form.php", Data: "edit_id=" + ExaminationId, Result: "#frmExaminationDiv" });
}









function OpenCertificatePage() {
    OpenUrl({Url: "certificate/index.php", Result: ".container", Complete: "OpenCertificateForm(-1);"});
}
function OpenCertificateForm(CertificateId) {
    OpenUrl({Url: "certificate/form.php", Data: "CertificateId=" + CertificateId , Result: "#frmCertificateDiv", Complete: "OpenCertificateTable();"});
}
function OpenCertificateTable() {
    OpenUrl({Url: "certificate/table.php", Data: $("#certificate_table").serialize(), Result: "#tblCertificateDiv"});
}
function SaveCertificateModul() {
    OpenUrl({Url: "certificate/save.php", Data: $("#store").serialize(), Result: ".container", Complete: "OpenCertificateForm(-1);"});
}
function RemoveCertificateTable(delete_id) {
    OpenUrl({Url: "certificate/delete.php", Data: "delete_id=" + delete_id,  Complete: "OpenCertificateTable();" });
}
function UpdateCertificate() {
    OpenUrl({ Url: "certificate/duzenle.php", Data: $("#editForm").serialize(), Complete: "OpenCertificateTable();" });
}
function OpenCertificateEdit(CertificateId) {
    OpenUrl({ Url: "certificate/duzenle_form.php", Data: "edit_id=" + CertificateId, Result: "#frmCertificateDiv" });
}









function OpenEducationPage() {
    OpenUrl({Url: "education/index.php", Result: ".container", Complete: "OpenEducationForm(-1);"});
}
function OpenEducationForm(CertificateId) {
    OpenUrl({Url: "education/form.php", Data: "EducationId=" + CertificateId , Result: "#frmEducationDiv", Complete: "OpenEducationTable();"});
}
function OpenEducationTable() {
    OpenUrl({Url: "education/table.php", Data: $("#education_table").serialize(), Result: "#tblEducationDiv"});
}
function SaveEducationModul() {
    OpenUrl({Url: "education/save.php", Data: $("#store").serialize(), Result: ".container", Complete: "OpenEducationForm(-1);"});
}
function RemoveEducationTable(delete_id) {
    OpenUrl({Url: "education/delete.php", Data: "delete_id=" + delete_id,  Complete: "OpenEducationTable();" });
}
function UpdateEducation() {
    OpenUrl({ Url: "education/duzenle.php", Data: $("#editForm").serialize(), Complete: "OpenEducationTable();" });
}
function OpenEducationEdit(EducationId) {
    OpenUrl({ Url: "education/duzenle_form.php", Data: "edit_id=" + EducationId, Result: "#frmEducationDiv" });
}
