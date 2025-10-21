import React from "react";
import { Link } from "react-router-dom";
import logo from "../assests/logo.png"; // your Al Mairaaj logo
import sideImage from "../assests/sideimage.png"; // right side image

export default function Login() {

  return (
    <div className="min-h-screen flex items-center justify-center bg-gradient-to-br from-teal-200 to-teal-400 p-4">
      <div className="flex flex-col md:flex-row bg-white rounded-2xl shadow-2xl overflow-hidden max-w-5xl w-full">
        
        {/* Left Section - Login Form */}
        <div className="w-full md:w-1/2 flex flex-col justify-center px-10 py-10">
          {/* Logo */}
          <div className="flex flex-col items-center mb-6">
            <img
              src={logo}
              alt="Al Mairaaj"
              className="w-40 h-auto mb-2"
            />
            <h2 className="text-xl font-semibold text-gray-800">Sign In</h2>
            <p className="text-sm text-gray-500 mt-1 text-center">
              Enter your information to access your account.
            </p>
          </div>

          {/* Form */}
          <form className="flex flex-col gap-4">
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
                Password <span className="text-red-500">*</span>
              </label>
              <input
                type="password"
                placeholder="Enter your password"
                required
                className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 focus:outline-none"
              />
            </div>

            <button
              type="submit"
              className="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 rounded-lg transition duration-200"
            >
              Sign In
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

        {/* Right Section - Image */}
        <div className="hidden md:flex md:w-1/2 items-center justify-center">
          <img
            src={sideImage}
            alt="Learning Platform"
            className="w-3/4 h-auto object-contain rounded-lg"
          />
        </div>
      </div>
    </div>
  );
}
