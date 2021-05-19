<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Confirmation Email</title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style type="text/css">
      body {
        margin: 0;
        background: #fefefe;
        color: #585858;
      }
      table {
        font-size: 15px;
        line-height: 23px;
        text-align: center;
      }
      .table_inner {
        min-width: 100% !important;
      }
      td {
        font-family: -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
        vertical-align: top;
      }
      .carpool_logo {
        margin: 30px auto;
      }
      .dummy_row {
        padding-top: 20px !important;
      }
      .section,
      .sectionlike {
        background: #c9f9e9;
      }
      .section {
        padding: 0 20px;
      }
      .sectionlike {
        padding-bottom: 10px;
      }
      .section_content {
        width: 100%;
        background: #fff;
      }
      .section_content_padded {
        padding: 0 35px 40px;
      }
      .section_zag {
        background: #f4fbf9;
      }
      .imageless_section {
        padding-bottom: 20px;
      }
      .img_section {
        width: 100%;
        max-width: 500px;
      }
      .img_section_side_table {
        width: 100% !important;
      }
      h1 {
        font-size: 20px;
        font-weight: 500;
        margin-top: 40px;
        margin-bottom: 0;
      }
      .near_title {
        margin-top: 10px;
      }
      .last {
        margin-bottom: 0;
      }
      a {
        color: #199eff;
        font-weight: 500;
        word-break: break-word; /* Footer has long unsubscribe link */
      }
      .button {
        display: block;
        width: 100%;
        max-width: 300px;
        background: #20da9c;
        border-radius: 8px;
        color: #fff;
        font-size: 18px;
        font-weight: normal; /* Resetting from a */
        padding: 12px 0;
        margin: 30px auto 0;
        text-decoration: none;
      }
      small {
        display: block;
        width: 100%;
        font-size: 14px;
        margin-top: 30px;
      }
      .signature {
        padding: 20px;
      }
      .footer,
      .footer_like {
        background: #1fd99a;
      }
      .footer {
        padding: 0 20px 30px;
      }
      .footer_content {
        width: 100%;
        text-align: center;
        font-size: 12px;
        line-height: initial;
        color: #005750;
      }
      .footer_content a {
        color: #005750;
      }
      .footer_item_image {
        margin: 0 auto 10px;
      }
      .footer_item_caption {
        margin: 0 auto;
      }
      .footer_legal {
        padding: 20px 0 40px;
        margin: 0;
        font-size: 12px;
        color: #a5a5a5;
        line-height: 1.5;
      }
      .text_left {
        text-align: left;
      }
      .text_right {
        text-align: right;
      }
      .va {
        vertical-align: middle;
      }
      .stats {
        min-width: auto !important;
        max-width: 370px;
        margin: 30px auto 0;
      }
      .counter {
        font-size: 22px;
      }
      .stats_counter {
        width: 23%;
      }
      .stats_image {
        width: 18%;
        padding: 0 10px;
      }
      .stats_meta {
        width: 59%;
      }
      .stats_spaced {
        padding-top: 16px;
      }
      .walkthrough_spaced {
        padding-top: 24px;
      }
      .walkthrough {
        max-width: none;
      }
      .walkthrough_meta {
        padding-left: 20px;
      }
      .table_checkmark {
        padding-top: 30px;
      }
      .table_checkmark_item {
        font-size: 15px;
      }
      .td_checkmark {
        width: 24px;
        padding: 7px 12px 0 0;
      }
      .padded_bottom {
        padding-bottom: 40px;
      }
      .marginless {
        margin: 0;
      }
      /* Restricting responsive for iOS Mail app only as Inbox/Gmail have render bugs */
      @media only screen and (max-width: 480px) and (-webkit-min-device-pixel-ratio: 2) {
        table {
          min-width: auto !important;
        }
        .section_content_padded {
          padding-right: 25px !important;
          padding-left: 25px !important;
        }
        .counter {
          font-size: 18px !important;
        }
      }
      .outside-color {
        background: #e0e0e0 !important;
      }
      .border-top-radius {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
      }
      .border-bottom-radius {
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
      }
      .border-top-radius2 {
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
      }
      .border-bottom-radius2 {
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
      }
    </style>
  </head>
  <!-- partial:index.partial.html -->
  <body style="margin: 0; background: #fefefe !important; color: #585858">
    <!-- Preivew text -->
    <table
      align="center"
      border="0"
      cellspacing="0"
      cellpadding="0"
      style="
        font-size: 15px;
        line-height: 23px;
        max-width: 650px;
        min-width: 460px;
        text-align: center;
        margin-top: 20px;
      "
    >
      <tbody>
        <!-- Header -->
        <tr>
          <td
            class="sectionlike imageless_section outside-color border-top-radius"
            style="
              font-family: -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
              vertical-align: top;
              border: none !important;
              padding-bottom: 10px;
              padding-bottom: 20px;
            "
          ></td>
        </tr>
        <!-- Content -->
        <tr>
          <td
            class="section outside-color"
            style="
              font-family: -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
              vertical-align: top;
              border: none !important;
              padding: 0 10px;
            "
          >
            <table
              border="0"
              cellspacing="0"
              cellpadding="0"
              class="section_content border-top-radius2"
              style="
                font-size: 15px;
                line-height: 23px;
                max-width: 650px;
                min-width: 460px;
                text-align: center;
                width: 100%;
                background: #fff;
              "
            >
              <tbody>
                <tr>
                  <td
                    class="section_content_padded"
                    style="
                      font-family: -apple-system, BlinkMacSystemFont, Roboto,
                        sans-serif;
                      vertical-align: top;
                      border: none !important;
                      padding: 0 35px 40px;
                    "
                  >
                    <h1
                      style="
                        font-size: 20px;
                        font-weight: 500;
                        margin-top: 40px;
                        margin-bottom: 0;
                      "
                    >
                      Halo {{$user->name}},
                    </h1>
                    <p
                      class="near_title last"
                      style="margin-top: 10px; margin-bottom: 0"
                    >
                      Selamat datang di Doca.Pets, Silakan verifikasi
                      email Anda dengan menekan tombol di bawah ini dan mulai
                      menjelajah di Website Doca.Pets.
                    </p>
                    <a
                      href="{{url("/verify/{$user->token}/{$user->id}")}}"
                      style="
                        display: block;
                        width: 100%;
                        max-width: 300px;
                        background: #d9222a;
                        border-radius: 8px;
                        color: #fff;
                        font-size: 18px;
                        padding: 12px 0;
                        margin: 30px auto 0;
                        text-decoration: none;
                      "
                      target="_blank"
                      >Verifikasi email</a
                    >
                    <small style="display: block; width: 100%; font-size: 14px">
                      Terima kasih telah memilih Doca.Pets. Semoga Anda
                      mendapatkan pengalaman yang menyenangkan. Jika tombol di
                      atas tidak berfungsi untuk Anda, klik tautan di bawah atau
                      salin-tempel ke browser Anda
                    </small>
                    <a
                      href="#"
                      style="
                        display: block;
                        font-size: 14px;
                        margin: 20px auto 0;
                        text-decoration: none;
                      "
                      target="_blank"
                      >{{url("/verify/{$user->token}/{$user->id}")}}</a
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <!-- Signature -->
        <tr>
          <td
            class="section outside-color"
            style="
              font-family: -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
              vertical-align: top;
              border: none !important;
              padding: 0 10px;
            "
          >
          </td>
        </tr>
        <!-- Footer -->
        <tr>
          <td
            class="section dummy_row outside-color border-bottom-radius"
            style="
              font-family: -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
              vertical-align: top;
              border: none !important;
              padding: 0 20px;
              padding-top: 20px !important;
            "
          />
        </tr>

        <!-- Legal footer -->
        <tr>
          <td
            style="
              font-family: -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
              vertical-align: top;
              border: none !important;
            "
          >
            <p
              class="footer_legal"
              style="
                padding: 20px 0 40px;
                margin: 0;
                font-size: 12px;
                color: #a5a5a5;
                line-height: 1.5;
              "
            >
              © 2020 All Rights Reserved by Doca.Pets.
              <br /><br />
            </p>
          </td>
        </tr>
      </tbody>
    </table>
  </body>
  <!-- partial -->
</html>
