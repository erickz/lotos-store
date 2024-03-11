@extends('layouts.email.email-basic')

@section('titleEmail', 'Password recovery')

@section('content')
    <tr>
        <td align="center" valign="top">
            <!-- BEGIN BODY // -->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">
                <tr>
                    <td valign="top" class="bodyContent" mc:edit="body_content">
                        <h1>Hello {{ $user->getNameWithUppercase() }}</h1>
                        We received a request to recover your password, follow the link to proceed
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
                                            <a href="{{ $resetLink }}" target="_blank">Reset your password</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top" class="bodyContent" mc:edit="body_content">
                        <h4>This password reset link will expire in {{ $expireCount }} minutes</h4>
                        <h4>If you did not request a password reset, no further action is required.</h4>
                    </td>
                </tr>
            </table>
            <!-- // END BODY -->
        </td>
    </tr>
@endsection