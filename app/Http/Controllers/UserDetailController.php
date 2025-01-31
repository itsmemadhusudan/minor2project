<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import the User model
use App\Models\Order; // Import the User model

class UserDetailController extends Controller
{
    /**
     * Display the admin profile with user details.
     *
     * @return \Illuminate\View\View
     */
    public function adminProfile()
    {
        // Fetch all user details from the users table
        $userDetails = User::select('id', 'name', 'email', 'phone')->get();
        $total_user_count = User::count();
        $total_order_count = Order::count();
        $total_revenue_count = Order::where('payment_status', 'Paid')->sum('total_amount');
        $recent_orders = Order::with('user')->limit(5)->get();

        $data = [
            'userDetails' => $userDetails,
            'total_user_count' => $total_user_count,
            'total_order_count' => $total_order_count,
            'total_revenue_count' => $total_revenue_count,
            'recent_orders' => $recent_orders,
        ];


        return view('dashboard.home', ['data' => $data]);
    }

    /**
     * Show the form to edit a specific user's details.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('admin.edit_user', compact('user'));
        } else {
            return redirect()->route('admin.profile')->with('error', 'User not found');
        }
    }

    /**
     * Update the user's details in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $user = User::find($id);
        if ($user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->save();

            return redirect()->route('admin.profile')->with('success', 'User updated successfully');
        } else {
            return redirect()->route('admin.profile')->with('error', 'User not found');
        }
    }

    /**
     * Delete a user from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.profile')->with('success', 'User deleted successfully');
        } else {
            return redirect()->route('admin.profile')->with('error', 'User not found');
        }
    }

    /**
     * Count the total number of users in the database.
     *
     * @return \Illuminate\View\View
     */
    public function countTotalUsers()
    {
        // Count the total number of users
        $totalUsers = User::count();

        // Pass the count to the view
        return view('admin.totalusers', compact('totalUsers'));
    }
}
