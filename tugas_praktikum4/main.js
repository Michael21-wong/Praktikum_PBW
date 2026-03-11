function cekNilai() {

    let nim = document.getElementById("Nim").value;
    let mk = document.getElementById("MK").value;
    let nilai = document.getElementById("Nilai").value;
    let hasil = document.getElementById("hasil");

    nilai = parseInt(nilai);

    if (nilai < 0 || nilai > 100) {
        hasil.innerHTML = "Nilai tidak valid!";
        return;
    }

    let grade;

    if (nilai >= 80 && nilai <= 100) {
        grade = "A";
    } 
    else if (nilai >= 70) {
        grade = "B";
    } 
    else if (nilai >= 60) {
        grade = "C";
    } 
    else if (nilai >= 50) {
        grade = "D";
    } 
    else {
        grade = "E";
    }

    hasil.innerHTML = "NIM: " + nim + "<br>Mata Kuliah:" + mk + "<br>Nilai: " + nilai + "<br>Huruf Mutu: " + grade;

    document.getElementById("Nim").value="";
    document.getElementById("MK").value="";
    document.getElementById("Nilai").value="";

    document.getElementById("Nim").focus();
}