@extends('layouts.email.email-basic')

@section('titleEmail', 'Password recovery')

@section('content')
    <tr>
        <td align="center" valign="top">
            <!-- BEGIN BODY // -->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">
                <tr>
                    <td valign="top" class="bodyContent" mc:edit="body_content">
                        <h1>Hello!!</h1>
                        Please click the button below to verify your email address.
                        <br />
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top" style="padding-top:0;">
                        <table border="0" cellpadding="15" cellspacing="0" class="templateButton">
                            <tbody>
                            <tr>
                                <td valign="middle" class="templateButtonContent">
                                    <div mc:edit="std_content02">
                                        <a href="{{ $verificationUrl }}" target="_blank">Verify Email Address</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top" class="bodyContent" mc:edit="body_content">
                        <h4>If you did not create an account, no further action is required.</h4>
                    </td>
                </tr>
            </table>
            <!-- // END BODY -->
        </td>
    </tr>
@endsection