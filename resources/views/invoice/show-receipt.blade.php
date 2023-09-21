<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Receipt for Invoice #{{ $invoice->invoiceID }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<style>
		<style>
      body{
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;

      }


      .btn-primary {
            background-color: #000000;
            border-color: #000000;
        }

        .btn-primary:hover {
            background-color: #2A2A2A; 
            border-color: #2A2A2A;
        }

#image-container {
    width: 50px; /* Adjust the desired width */
    height: 50px; /* Adjust the desired height */
    overflow: hidden;
}
      
    #logo {
        max-width: 100%; /* Ensure the image scales down proportionally */
        max-height: 100%; /* Ensure the image scales down proportionally */
        width: auto; /* Override the width to let the max-width property control it */
        height: auto; /* Override the height to let the max-height property control it */
    }

			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}


      .invoice-box table tr.paid td:nth-child(2) {
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: left;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body style="position: relative;" >
    <div class="mx-auto d-block text-center">
      <h1 class="mt-4 mb-4 font-weight-bold">Thank you for choosing MyCSC@UMS!</h1>
    </div>
    

		<div class="invoice-box" id="receipt-box">
      
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
                <td>
                  <div class="image-container">
                    <img id='logo' src="{{ asset('img/mycsc-logo-light.png') }}" 
                  alt=""
                  width="100px"
                  height="200px">
                  </div>
                  
                </td>
								<td>
									Receipt for Invoice #: {{ $invoice->invoiceID }}<br />
									<br/>
                  <br/>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									My Cyber Security Clinic UMS<br />
									Blok A, Bangunan FKJ<br />
									Jalan UMS, 88400 Kota Kinabalu, Sabah
								</td>

								<td>
									{{ $invoice-> clientName}}<br />
									{{ $invoice-> clientPhoneNo}}<br />
									{{ $invoice-> clientEmail}}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Service Type</td>

					<td>Price</td>
				</tr>


				<tr class="item last">
					<td>{{ $invoice->serviceType}} ({{ $invoice->capacityRestored }}GB)</td>

					<td>RM{{ $invoice->totalPayable }}</td>
				</tr>

				<tr class="total">
					<td></td>

					<td>Total: RM{{ $invoice->totalPayable }}</td>
        </tr>
          <tr class="paid">
            <td></td>
  
            <td>Paid: RM{{ $invoice->paymentAmount }}</td>
				</tr>
        <tr class="total">
					<td></td>

					<td>Balance Due: RM{{ $invoice->balanceDue }}</td>
        </tr>
			</table>
      <small>This receipt is computer-generated and does not require a physical signature.




      </small>
		</div>

    
    {{-- <button class="btn btn-primary" onclick="Convert_HTML_To_PDF();">Convert HTML to PDF</button> --}}

    <div class="row d-flex justify-content-center align-items-center" >
      <div class="form-group col-md-8 p-0" style="max-width:802px">
          
          <button type="submit" onclick="Convert_HTML_To_PDF();" class="btn btn-primary btn-block" >Download as PDF <i class="fa fa-file-pdf"
                  aria-hidden="true"></i></button>
      </div>
  </div>
	</body>

  


  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
window.jsPDF = window.jspdf.jsPDF;    
function Convert_HTML_To_PDF() {
    var doc = new jsPDF({ orientation: 'landscape' });
	
    // Source HTMLElement or a string containing HTML.
    var elementHTML = document.querySelector("#receipt-box");
    var pageWidth = doc.internal.pageSize.getWidth();

    doc.html(elementHTML, {
        callback: function(doc) {
            // Save the PDF
            doc.save('invoice.pdf');
        },
        margin: [0, 0, 10, 10],
        autoPaging: 'text',
        x: 10,
        y: 0,
        width: 255, 
        windowWidth: 675 //window width in CSS pixels
    });
}
</script>


</html>

