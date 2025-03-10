var show = 0;
function showBox() {
  box = document.getElementById('box');
  if (show == 0) {
    box.style.height = "100px";
    show = 1;
  } else {
    box.style.height = "0px";
    show = 0;
  }
}

function domReady(fn) {
  if (
    document.readyState === "complete" ||
    document.readyState === "interactive"
  ) {
    setTimeout(fn, 1000);
  } else {
    document.addEventListener("DOMContentLoaded", fn);
  }
}

domReady(function () {

  // If found you qr code
  function onScanSuccess(decodeText, decodeResult) { 
    console.log(decodeText);

    let qr_info = JSON.parse(decodeText);

    current_date = new Date();
    qr_date = new Date(qr_info.date);

    current_time = current_date.getTime();
    qr_time = qr_date.getTime();

    time_difference = (current_time-qr_time)/(1000*60);

    h=0;
    if(time_difference<45){
      window.location.href = "scan_qr.php?s_id=<?php echo $_SESSION['id'];?>&s_name=<?php echo $_SESSION['student_name'];?>&rollno=<?php echo $_SESSION['rollno'];?>&section=<?php echo $_SESSION['section']; ?>&subject="+qr_info.subject+"&date="+qr_info.date;
    }else{
      window.location.href = "expired.php";
    }
  }

  let htmlscanner = new Html5QrcodeScanner(
    "my-qr-reader",
    { fps: 10, qrbos: 250 }
  );
  htmlscanner.render(onScanSuccess);
});