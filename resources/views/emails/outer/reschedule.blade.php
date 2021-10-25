@inject('formatter', 'App\Formatter')
@php
    if($reservation->confirmations->count()>=2){
        $beforeConfirmation = $reservation->confirmations->get($reservation->confirmations->count()-2); /* 이전 */
        $confirmation = \App\Confirmation::whereReservationId($reservation->id)->latest()->first(); /* 현재 */
    }
@endphp
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office"
      style="width:100%;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title>트래블메이커스 호텔에삶</title>
    <!--[if (mso 16)]>
    <style type="text/css">
    a {
        text-decoration: none;
    }
    </style>
    <![endif]-->
    <!--[if gte mso 9]>
    <style>sup {
        font-size: 100% !important;
    }</style><![endif]-->
    <!--[if gte mso 9]>
    <xml>
    <o:OfficeDocumentSettings>
        <o:AllowPNG></o:AllowPNG>
        <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <!--[if !mso]> -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet">
    <!--<![endif]-->
    <style type="text/css">
        #outlook a {
            padding: 0;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }

        .es-button {
            mso-style-priority: 100 !important;
            text-decoration: none !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        .es-desk-hidden {
            display: none;
            float: left;
            overflow: hidden;
            width: 0;
            max-height: 0;
            line-height: 0;
            mso-hide: all;
        }

        @media only screen and (max-width: 600px) {
            p, ul li, ol li, a {
                font-size: 16px !important;
                line-height: 150% !important
            }

            h1 {
                font-size: 32px !important;
                text-align: center;
                line-height: 120% !important
            }

            h2 {
                font-size: 26px !important;
                text-align: center;
                line-height: 120% !important
            }

            h3 {
                font-size: 20px !important;
                text-align: center;
                line-height: 120% !important
            }

            h1 a {
                font-size: 32px !important
            }

            h2 a {
                font-size: 26px !important
            }

            h3 a {
                font-size: 20px !important
            }

            .es-menu td a {
                font-size: 16px !important
            }

            .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a {
                font-size: 16px !important
            }

            .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a {
                font-size: 16px !important
            }

            .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a {
                font-size: 12px !important
            }

            *[class="gmail-fix"] {
                display: none !important
            }

            .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 {
                text-align: center !important
            }

            .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 {
                text-align: right !important
            }

            .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 {
                text-align: left !important
            }

            .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img {
                display: inline !important
            }

            .es-button-border {
                display: inline-block !important
            }

            .es-btn-fw {
                border-width: 10px 0px !important;
                text-align: center !important
            }

            .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right {
                width: 100% !important
            }

            .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header {
                width: 100% !important;
                max-width: 600px !important
            }

            .es-adapt-td {
                display: block !important;
                width: 100% !important
            }

            .adapt-img {
                height: auto !important
            }

            .es-m-p0 {
                padding: 0px !important
            }

            .es-m-p0r {
                padding-right: 0px !important
            }

            .es-m-p0l {
                padding-left: 0px !important
            }

            .es-m-p0t {
                padding-top: 0px !important
            }

            .es-m-p0b {
                padding-bottom: 0 !important
            }

            .es-m-p20b {
                padding-bottom: 20px !important
            }

            .es-mobile-hidden, .es-hidden {
                display: none !important
            }

            tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden {
                width: auto !important;
                overflow: visible !important;
                float: none !important;
                max-height: inherit !important;
                line-height: inherit !important
            }

            tr.es-desk-hidden {
                display: table-row !important
            }

            table.es-desk-hidden {
                display: table !important
            }

            td.es-desk-menu-hidden {
                display: table-cell !important
            }

            .es-menu td {
                width: 1% !important
            }

            table.es-table-not-adapt, .esd-block-html table {
                width: auto !important
            }

            table.es-social {
                display: inline-block !important
            }

            table.es-social td {
                display: inline-block !important
            }

            a.es-button, button.es-button {
                font-size: 16px !important;
                display: inline-block !important
            }
        }
    </style>
</head>
<body
    style="width:100%;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
<div class="es-wrapper-color" >
    <!--[if gte mso 9]>
    <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
    <v:fill type="tile" color="#eeeeee"></v:fill>
    </v:background>
    <![endif]-->
    <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0"
           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top">
        <tr style="border-collapse:collapse">
            <td valign="top" style="padding:0;Margin:0">
                <table class="es-content" cellspacing="0" cellpadding="0" align="center"
                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                    <tr style="border-collapse:collapse"></tr>
                    <tr style="border-collapse:collapse">
                        <td align="center" style="padding:0;Margin:0">
                            <table class="es-header-body"
                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#044767;width:600px"
                                   cellspacing="0" cellpadding="0" bgcolor="#044767" align="center">
                                <tr style="border-collapse:collapse">
                                    <td align="left" bgcolor="#30373f"
                                        style="padding:25px;Margin:0;background-color:#30373F">
                                        <table cellspacing="0" cellpadding="0" align="left" class="es-left"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                            <tr style="border-collapse:collapse">
                                                <td class="es-m-p0r es-m-p20b" valign="top" align="center"
                                                    style="padding:0;Margin:0;width:419px">
                                                    <table width="100%" cellspacing="0" cellpadding="0"
                                                           role="presentation"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td class="es-m-txt-c" align="left"
                                                                style="padding:0;Margin:0">
                                                                <h1
                                                                    style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:36px;font-style:normal;font-weight:bold;color:#FFFFFF">
                                                                    <font style="vertical-align:inherit">트래블메이커스
                                                                    </font>
                                                                </h1>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>

                                        <table cellpadding="0" cellspacing="0" class="es-right" align="right"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                            <tr style="border-collapse:collapse">
                                                <td align="left" style="padding:0;Margin:0;width:111px">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                           role="presentation"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" style="padding:0;Margin:0;font-size:0px">
                                                                <img class="adapt-img"
                                                                     src="https://d2pyzcqibfhr70.cloudfront.net/resource/logos/logo_logotype_white.png"
                                                                     alt
                                                                     style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
                                                                     width="111"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table class="es-content" cellspacing="0" cellpadding="0" align="center"
                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                    <tr style="border-collapse:collapse">
                        <td align="center" style="padding:0;Margin:0">
                            <table class="es-content-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff"
                                   align="center"
                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                                <tr style="border-collapse:collapse">
                                    <td align="left"
                                        style="padding:0;Margin:0;padding-left:35px;padding-right:35px;padding-top:40px">
                                        <table width="100%" cellspacing="0" cellpadding="0"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                            <tr style="border-collapse:collapse">
                                                <td valign="top" align="center" style="padding:0;Margin:0;width:530px">
                                                    <table width="100%" cellspacing="0" cellpadding="0"
                                                           role="presentation"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" style="padding:0;Margin:0">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:58px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:87px;color:#333333">
                                                                    <span style="font-size:32px;line-height: 2.5rem">
                                                                        <strong>
                                                                            호텔 입주 {{$reschedule_type}} 신청이 들어왔습니다.
                                                                        </strong>
                                                                    </span>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table class="es-content" cellspacing="0" cellpadding="0" align="center"
                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                    <tr style="border-collapse:collapse">
                        <td align="center" style="padding:0;Margin:0">
                            <table class="es-content-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff"
                                   align="center"
                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                                <tr style="border-collapse:collapse">
                                    <td align="left"
                                        style="padding:0;Margin:0;padding-top:20px;padding-left:35px;padding-right:35px">
                                        <table width="100%" cellspacing="0" cellpadding="0"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                            <tr style="border-collapse:collapse">
                                                <td valign="top" align="center" style="padding:0;Margin:0;width:530px">
                                                    <table width="100%" cellspacing="0" cellpadding="0"
                                                           role="presentation"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td bgcolor="#eeeeee" align="left"
                                                                style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px">
                                                                <table
                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:500px"
                                                                    class="cke_show_border" cellspacing="1"
                                                                    cellpadding="1" border="0" align="left"
                                                                    role="presentation">
                                                                    <tr style="border-collapse:collapse">
                                                                        <td width="80%" style="padding:0;Margin:0">
                                                                            <h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif">
                                                                                입주 {{$reschedule_type}} 신청 정보
                                                                            </h4>
                                                                        </td>
                                                                        <td width="20%" style="padding:0;Margin:0">
                                                                            <h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif">
                                                                                <br></h4>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="border-collapse:collapse">
                                    <td align="left"
                                        style="padding:0;Margin:0;padding-top:20px;padding-left:35px;padding-right:35px">
                                        <table cellpadding="0" cellspacing="0" width="100%"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                            <tr style="border-collapse:collapse">
                                                <td align="center" valign="top" style="padding:0;Margin:0;width:530px">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                           role="presentation"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="left" style="padding:5px;Margin:0">
                                                                <ul>
                                                                    <li style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;Margin-bottom:15px;color:#333333">
                                                                        {{--<font style="vertical-align:inherit">호텔명</font>--}}
                                                                        <font style="font-weight:bold;vertical-align:inherit">{{$reservation->hotel->option->title ?? '정보없음'}}</font>
                                                                    </li>
                                                                </ul>
                                                                @isset($reservation->type)
                                                                    @if($reservation->type === 'month')
                                                                        <ul>
                                                                            <li style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;Margin-bottom:15px;color:#333333">
                                                                                <font style="vertical-align:inherit">옵션</font>
                                                                                <ul>
                                                                                    <li style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;Margin-bottom:15px;color:#333333">
                                                                                        <font style="vertical-align:inherit">{{$reservation->room->title ?? '정보없음'}}
                                                                                            {{$reservation->room->nights ? '('.$reservation->room->nights.'박' : ''}}
                                                                                            {{$reservation->room->nights ? ' '.$reservation->room->days.'일)' : ''}}
                                                                                        </font>
                                                                                    </li>
                                                                                </ul>
                                                                            </li>
                                                                        </ul>
                                                                        <ul>
                                                                            <li style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;Margin-bottom:15px;color:#333333">
                                                                                <font style="vertical-align:inherit">상품 룸 타입</font>
                                                                                <ul>
                                                                                    <li style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;Margin-bottom:15px;color:#333333">
                                                                                        <font style="vertical-align:inherit">
                                                                                            @if(isset($reservation->room_type_id))
                                                                                                {{$reservation->roomType->name}}
                                                                                                @isset($reservation->room_type_upgrade_id) > <span style="font-weight: bold;">{{ $reservation->roomTypeUpgrade->name}}(업그레이드 적용)</span> @endisset
                                                                                                @else
                                                                                                {{$reservation->room->main_explanation ?? '정보없음'}}
                                                                                            @endif
                                                                                        </font>
                                                                                    </li>
                                                                                </ul>
                                                                            </li>
                                                                        </ul>
                                                                        @if(isset($confirmation) && $beforeConfirmation->room_type!==$confirmation->room_type)
                                                                            <ul>
                                                                                <li style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;Margin-bottom:15px;color:#333333">
                                                                                    <font style="vertical-align:inherit">변경 룸타입</font>
                                                                                    <ul>
                                                                                        <li style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;Margin-bottom:15px;color:#333333">
                                                                                            <font style="vertical-align:inherit">
                                                                                                {{$beforeConfirmation->room_type}} > {{$confirmation->room_type ?? '정보없음'}}
                                                                                            </font>
                                                                                        </li>
                                                                                    </ul>
                                                                                </li>
                                                                            </ul>
                                                                        @endif
                                                                    @endif
                                                                @endisset

                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center"
                                                                style="padding:20px;Margin:0;font-size:0">
                                                                <table border="0" width="100%" height="100%"
                                                                       cellpadding="0" cellspacing="0"
                                                                       role="presentation"
                                                                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr style="border-collapse:collapse">
                                                                        <td style="padding:0;Margin:0;border-bottom:1px solid #CCCCCC;background:none;height:1px;width:100%;margin:0px"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="border-collapse:collapse">
                                    <td align="left" style="Margin:0;padding-top:15px;padding-bottom:15px;padding-right:30px;padding-left:35px">
                                        <table class="es-left" cellspacing="0" cellpadding="0" align="left"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                            <tr style="border-collapse:collapse">
                                                <td class="es-m-p20b" align="left"
                                                    style="padding:0;padding-left:10px;Margin:0;width:270px">
                                                 자

                                                    <table width="100%" cellspacing="0" cellpadding="0"
                                                           role="presentation"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="left" style="padding:0;Margin:0;padding-bottom:15px">
                                                                <h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif">
                                                                    <font style="vertical-align:inherit">주문자명</font>
                                                                </h4>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse">
                                                            <td align="left" style="padding:0;Margin:0;padding-bottom:10px">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;color:#333333">
                                                                    <span style="font-weight: bold;">
                                                                        {{$reservation->order_name ?? '정보없음'}}
                                                                    </span>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>

                                            <tr style="border-collapse:collapse">
                                                <td align="left" style="padding:0;Margin:0;padding-bottom:15px">
                                                    <h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif">
                                                        <font style="vertical-align:inherit">결제자명</font>
                                                    </h4>
                                                </td>
                                            </tr>
                                            <tr style="border-collapse:collapse">
                                                <td align="left" style="padding:0;Margin:0;padding-bottom:10px">
                                                    <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;color:#333333">
                                                        {{$reservation->payment->name ?? '정보없음'}}
                                                    </p>
                                                </td>
                                            </tr>



                                            </td>
                                            </tr>

                                            @if(isset($confirmation) && $confirmation->add_days>=1 && $beforeConfirmation->add_days < $confirmation->add_days)
                                            <tr style="border-collapse:collapse;">
                                                <td class="es-m-p20b" align="left"
                                                    style="padding:0;padding-top:15px;padding-left:10px;Margin:0;width:270px">
                                                    <table width="100%" cellspacing="0" cellpadding="0"
                                                           role="presentation"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="left" style="padding:0;Margin:0;padding-bottom:15px">
                                                                <h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif">
                                                                    이전 연장 박 수
                                                                </h4>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse">
                                                            <td align="left" style="padding:0;Margin:0">
                                                                <p style="font-size:18px;Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;color:#333333">
                                                                    {{ $beforeConfirmation->add_days ?? '0' }}박
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td class="es-m-p20b" align="left" style="padding:0;padding-top:15px;Margin:0;width:250px">
                                                    <table width="100%" cellspacing="0" cellpadding="0"
                                                           role="presentation"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="left" style="padding:0;Margin:0;padding-bottom:15px">
                                                                <h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif">
                                                                    추가 {{$reschedule_type}} 박 수
                                                                </h4>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse">
                                                            <td align="left" style="padding:0;Margin:0">
                                                                <p style="font-size:18px;Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;color:#333333">
                                                                    {{ $confirmation->add_days - $beforeConfirmation->add_days }}박
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            @endif
                                        </table>
                                    </td>
                                </tr>
                                @if(isset($confirmation) &&
                                    $beforeConfirmation->start_dt === $confirmation->start_dt
                                    && $beforeConfirmation->end_dt === $confirmation->end_dt)
                                    <tr>
                                        <td align="left" style="Margin:0;padding-top:15px;padding-bottom:15px;padding-right:30px;padding-left:35px">
                                            <table class="es-right" cellspacing="0" cellpadding="0" align="left"
                                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                <tr style="border-collapse:collapse">
                                                    <td align="left" style="padding:0;Margin:0;width:250px">
                                                        <table width="100%" cellspacing="0" cellpadding="0"
                                                               role="presentation"
                                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr style="border-collapse:collapse">
                                                                <td align="left" style="padding:0;Margin:0;padding-bottom:15px">
                                                                    <h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif">
                                                                        입주, 퇴실일 변경 없음
                                                                    </h4>
                                                                </td>
                                                            </tr>
                                                            <tr style="border-collapse:collapse">
                                                                <td align="left" style="padding:0;Margin:0">
                                                                    <p style="font-size:18px;Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;color:#333333">
                                                                        {{ $formatter->carbonFormat(\Carbon\Carbon::parse($beforeConfirmation->start_dt)->format('Y-m-d H:i:s'), 'Y년 m월 d일(요일) H시 i분') }}
                                                                    </p>
                                                                    <p style="Margin:0;">~</p>
                                                                    <p style="font-size:18px;Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;color:#333333">
                                                                        {{ $formatter->carbonFormat(\Carbon\Carbon::parse($beforeConfirmation->end_dt)->format('Y-m-d H:i:s'), 'Y년 m월 d일(요일) H시 i분') }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                @else
                                    <tr style="border-collapse:collapse">
                                        <td align="left" style="Margin:0;padding-top:15px;padding-bottom:15px;padding-right:30px;padding-left:35px">
                                            <table class="es-right" cellspacing="0" cellpadding="0" align="right"
                                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                <tr style="border-collapse:collapse">
                                                    <td align="left" style="padding:0;Margin:0;width:250px">
                                                        <table width="100%" cellspacing="0" cellpadding="0"
                                                               role="presentation"
                                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr style="border-collapse:collapse">
                                                                <td align="left" style="padding:0;Margin:0;padding-bottom:15px">
                                                                    <h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif">
                                                                        입주 {{$reschedule_type}} 이전 확정 정보
                                                                    </h4>
                                                                </td>
                                                            </tr>
                                                            <tr style="border-collapse:collapse">
                                                                <td align="left" style="padding:0;Margin:0">
                                                                    <p style="font-size:18px;Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;color:#333333">
                                                                        {{ $formatter->carbonFormat(\Carbon\Carbon::parse($beforeConfirmation->start_dt)->format('Y-m-d H:i:s'), 'Y년 m월 d일(요일) H시 i분') }}
                                                                    </p>
                                                                    <p style="Margin:0;">~</p>
                                                                    <p style="font-size:18px;Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;color:#333333">
                                                                        {{ $formatter->carbonFormat(\Carbon\Carbon::parse($beforeConfirmation->end_dt)->format('Y-m-d H:i:s'), 'Y년 m월 d일(요일) H시 i분') }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td align="left" style="font-weight: bold;padding:0;Margin:0;">
                                                        >>
                                                    </td>
                                                    <td align="left" style="Margin:0;width:250px;padding: 0 0 0 20px;">
                                                        <table width="100%" cellspacing="0" cellpadding="0"
                                                               role="presentation"
                                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr style="border-collapse:collapse">
                                                                <td align="left" style="padding:0;Margin:0;padding-bottom:15px">
                                                                    <h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif">
                                                                        입주 {{$reschedule_type}} 예정 정보
                                                                    </h4>
                                                                </td>
                                                            </tr>
                                                            <tr style="border-collapse:collapse">
                                                                <td align="left" style="padding:0;Margin:0">
                                                                    <p style="font-size:18px;Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;color:#333333">
                                                                        @if(isset($confirmation) && $confirmation->start_dt !== null)
                                                                            {{ $formatter->carbonFormat(\Carbon\Carbon::parse($confirmation->start_dt)->format('Y-m-d H:i:s'), 'Y년 m월 d일(요일) H시 i분') }}
                                                                        @else
                                                                            예정없음
                                                                        @endif
                                                                    </p>
                                                                    <p style="Margin:0;">~</p>
                                                                    <p style="font-size:18px;Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;color:#333333">
                                                                        @if(isset($confirmation) && $confirmation->end_dt !== null)
                                                                            {{ $formatter->carbonFormat(\Carbon\Carbon::parse($confirmation->end_dt)->format('Y-m-d H:i:s'), 'Y년 m월 d일(요일) H시 i분') }}
                                                                        @else
                                                                            예정없음
                                                                        @endif
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                @endif


                                <tr style="border-collapse:collapse">
                                    <td align="left" style="padding:0;Margin:0;padding-left:35px;padding-right:35px">
                                        <table cellspacing="0" cellpadding="0" width="100%"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                            <tr style="border-collapse:collapse">
                                                <td valign="top" align="center" style="padding:0;Margin:0;width:530px">
                                                    <table width="100%" cellspacing="0" cellpadding="0"
                                                           role="presentation"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center"
                                                                style="padding:20px;Margin:0;font-size:0">
                                                                <table border="0" width="100%" height="100%"
                                                                       cellpadding="0" cellspacing="0"
                                                                       role="presentation"
                                                                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr style="border-collapse:collapse">
                                                                        <td style="padding:0;Margin:0;border-bottom:1px solid #CCCCCC;background:none;height:1px;width:100%;margin:0px"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center"
                                                                style="font-size:24px;color:#30373F;font-weight: bold;padding:0;Margin:0;padding-top:10px;padding-bottom:25px">
                                                                아래에서 {{$reschedule_type}} 확정 진행 부탁드립니다 :)
                                                                {{--
                                                                <img class="adapt-img" alt="확정기한" title="확정기한"
                                                                     width="288"
                                                                     src="https://cdt-timer.stripocdn.email/api/v1/images/yoTqUB6l3xw3nstiRXggJn3yqkop6ypyTWXzpgdXb8U?l=1606870455835"
                                                                     style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic">--}}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table class="es-content" cellspacing="0" cellpadding="0" align="center"
                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                    <tr style="border-collapse:collapse">
                        <td align="center" style="padding:0;Margin:0">
                            <table class="es-content-body"
                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#C1A485;width:600px" cellspacing="0" cellpadding="0" bgcolor="#1b9ba3" align="center">
                                <tr style="border-collapse:collapse">
                                    <td align="left"
                                        style="Margin:0;padding-top:35px;padding-bottom:35px;padding-left:35px;padding-right:35px">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                            <tr style="border-collapse:collapse">
                                                <td valign="top" align="center" style="padding:0;Margin:0;width:530px">
                                                    <table width="100%" cellspacing="0" cellpadding="0"
                                                           role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:25px">
                                                                <h2 style="Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#FFFFFF">
                                                                    지금 입주 {{$reschedule_type}} 확정해주세요!
                                                                </h2>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" style="Margin:0;padding-left:10px;padding-right:10px;padding-bottom:15px;padding-top:30px">
                                                                <span class="es-button-border" style="border-style:solid;border-color:transparent;background:#66B3B7;border-width:0px;display:inline-block;border-radius:5px;width:auto">
                                                                    <a href="{{ route('external.hotel.confirmation.checking',['key'=>$external->access_key])}}"
                                                                        class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#d2c0ad;border-width:15px 30px 15px 30px;display:inline-block;background:#d2c0ad;border-radius:5px;font-weight:bold;font-style:normal;line-height:22px;width:auto;text-align:center">
                                                                        진행하기
                                                                    </a>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" style="">
                                                                <span>
                                                                    * 진행하기 클릭 후 확정 처리 진행해주세요.
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center"
                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
                    <tr style="border-collapse:collapse">
                        <td align="center" style="padding:0;Margin:0">
                            <table class="es-footer-body" cellspacing="0" cellpadding="0" align="center"
                                   bgcolor="#b97430"
                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#D7D3CF;width:600px">
                                <tr style="border-collapse:collapse">
                                    <td align="left" style="padding:35px;Margin:0">
                                        <table cellpadding="0" cellspacing="0" width="100%"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                            <tr style="border-collapse:collapse">
                                                <td align="center" valign="top" style="padding:0;Margin:0;width:530px">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                           role="presentation"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center"
                                                                style="padding:0;Margin:0;padding-top:25px">
                                                                <h2 style="Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#30373F">
                                                                    변경이 필요합니다!
                                                                </h2>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center"
                                                                style="Margin:0;padding-left:10px;padding-right:10px;padding-bottom:15px;padding-top:30px">
                                                                <span class="es-button-border"
                                                                      style="border-style:solid;border-color:transparent;background:#AFA223;border-width:0px;display:inline-block;border-radius:5px;width:auto">
                                                                    <a href="{{route('external.hotel.confirmation.change.checking',['key'=>$external->access_key])}}"
                                                                        class="es-button" target="_blank"
                                                                        style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:18px;color:#30373F;border-style:solid;border-color:#e9e6e4;border-width:15px 30px 15px 30px;display:inline-block;background:#e9e6e4;border-radius:5px;font-weight:bold;font-style:normal;line-height:22px;width:auto;text-align:center">
                                                                        진행하기
                                                                    </a>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" style="">
                                                                <span>
                                                                    * 진행하기 클릭 후 변경 처리 진행 해주세요.<br>담당자 연락처 : 1599-4330
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table class="es-content" cellspacing="0" cellpadding="0" align="center"
                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                    <tr style="border-collapse:collapse">
                        <td align="center" style="padding:0;Margin:0">
                            <table class="es-content-body"
                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px"
                                   cellspacing="0" cellpadding="0" align="center">
                                <tr style="border-collapse:collapse">
                                    <td align="left"
                                        style="padding:0;Margin:0;padding-top:20px;padding-left:35px;padding-right:35px">
                                        <table cellpadding="0" cellspacing="0" width="100%"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                            <tr style="border-collapse:collapse">
                                                <td align="center" valign="top" style="padding:0;Margin:0;width:530px">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                           role="presentation"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" style="padding:10px;Margin:0">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;color:#333333">
                                                                    <strong>트래블메이커스</strong>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="border-collapse:collapse">
                                    <td align="left"
                                        style="Margin:0;padding-left:20px;padding-right:20px;padding-top:15px;padding-bottom:15px">
                                        <table width="100%" cellspacing="0" cellpadding="0"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                            <tr style="border-collapse:collapse">
                                                <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                                                    <table width="100%" cellspacing="0" cellpadding="0" role="presentation"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="center" style="padding:0;Margin:0;font-size:0px">
                                                                <a href="{{secure_url('/')}}">
                                                                    <img class="adapt-img" src="https://d2pyzcqibfhr70.cloudfront.net/resource/logos/logo_normal_navy.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="110">
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
