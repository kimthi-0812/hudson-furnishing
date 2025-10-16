<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Hiển thị trang chỉnh sửa thông tin cá nhân
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit_simple', compact('user'));
    }

    /**
     * Cập nhật thông tin cá nhân
     */
    public function update(Request $request)
    {
        try {
            $user = Auth::user();
            
            Log::info('Profile update request', [
                'user_id' => $user->id,
                'data' => $request->all()
            ]);

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'username' => 'nullable|string|max:255|unique:users,username,' . $user->id,
            ], [
                'name.required' => 'Vui lòng nhập họ và tên.',
                'name.max' => 'Họ và tên không được vượt quá 255 ký tự.',
                'email.required' => 'Vui lòng nhập địa chỉ email.',
                'email.email' => 'Địa chỉ email không hợp lệ.',
                'email.unique' => 'Địa chỉ email này đã được sử dụng.',
                'username.unique' => 'Tên người dùng này đã được sử dụng.',
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
            ]);

            Log::info('Profile updated successfully', ['user_id' => $user->id]);

            return redirect()->route('profile.edit')->with('success', 'Thông tin cá nhân đã được cập nhật thành công!');
            
        } catch (\Exception $e) {
            Log::error('Profile update error', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('profile.edit')
                ->withErrors(['error' => 'Có lỗi xảy ra khi cập nhật thông tin. Vui lòng thử lại.'])
                ->withInput();
        }
    }

    /**
     * Hiển thị trang đổi mật khẩu
     */
    public function editPassword()
    {
        return view('profile.edit-password');
    }

    /**
     * Cập nhật mật khẩu
     */
    public function updatePassword(Request $request)
    {
        try {
            Log::info('Password update request', ['user_id' => Auth::id()]);

            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ], [
                'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
                'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
                'new_password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
                'new_password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
            ]);

            $user = $request->user();

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            Log::info('Password updated successfully', ['user_id' => $user->id]);

            return redirect()->route('profile.edit')->with('password_success', 'Mật khẩu đã được đổi thành công!');
            
        } catch (\Exception $e) {
            Log::error('Password update error', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('profile.edit')
                ->withErrors(['error' => 'Có lỗi xảy ra khi đổi mật khẩu. Vui lòng thử lại.']);
        }
    }
}
