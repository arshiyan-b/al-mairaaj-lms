import React from "react";
import { Link } from "react-router-dom";
import logo from "../assests/logo.png"; // your Al Mairaaj logo

export default function Otp() {
  return (
    <div className="min-h-screen flex items-center justify-center bg-gradient-to-br from-teal-200 to-teal-400 p-4">
      <div className="bg-white rounded-2xl shadow-2xl overflow-hidden max-w-md w-full p-10 flex flex-col items-center">
        
        {/* Logo Section */}
        <div className="flex flex-col items-center mb-6 text-center">
          <img
            src={logo}
            alt="Al Mairaaj"
            className="w-60 h-auto mb-2"
          />
          <p className="text-sm text-gray-500 mt-1">
            You'll receive an OTP to your email.
          </p>
        </div>

        {/* Form */}
        <form className="w-full flex flex-col gap-4">
          <div>
            <label className="block text-gray-700 text-sm font-medium mb-1">
              Email Address <span className="text-red-500">*</span>
            </label>
            <input
              type="email"
              placeholder="Enter your email"
              required
              className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 focus:outline-none"
            />
          </div>

          <div>
            <label className="block text-gray-700 text-sm font-medium mb-1">
              OTP <span className="text-red-500">*</span>
            </label>
            <input
              type="text"
              placeholder="Enter your OTP"
              required
              className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 focus:outline-none"
            />
          </div>

          <button
            type="submit"
            className="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 rounded-lg transition duration-200"
          >
            Submit
          </button>
        </form>

        {/* Footer */}
        <div className="text-center mt-4 text-sm text-gray-600">
          Don't have an account?{" "}
          <Link
            to="/register"
            className="text-teal-600 hover:underline font-medium"
          >
            Register
          </Link>
        </div>
      </div>
    </div>
  );
}
