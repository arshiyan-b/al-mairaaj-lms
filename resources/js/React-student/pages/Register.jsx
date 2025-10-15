import React from "react";
import { Link } from "react-router-dom";
import image from "../assests/logo.png";

export default function Register() {
  return (
    <div className="min-h-screen flex items-center justify-center bg-gradient-to-br from-teal-300 to-teal-500 p-6">
      {/* Form Box */}
      <div className="bg-white shadow-lg rounded-xl w-full max-w-3xl p-8 md:p-10 mx-4">
        {/* Logo Section */}
        <div className="flex flex-col items-center mb-6">
          <img
            src={image}
            alt="AL Mairaaj"
            className="w-40 h-auto mb-2"
          />
          <h2 className="text-xl font-semibold">Student Registration Form</h2>
          <p className="text-sm text-gray-500 mt-1 text-center">
            Enter your information to create an account.
          </p>
        </div>

        {/* Registration Form */}
        <form className="grid grid-cols-1 md:grid-cols-2 gap-5">
          {/* Left Column */}
          <div>
            <label className="block text-gray-700 text-sm font-medium mb-1">
              First Name <span className="text-red-500">*</span>
            </label>
            <input
              type="text"
              placeholder="Enter your first name"
              required
              className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            />
          </div>

          <div>
            <label className="block text-gray-700 text-sm font-medium mb-1">
              Middle Name
            </label>
            <input
              type="text"
              placeholder="Enter your middle name"
              className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            />
          </div>

          <div>
            <label className="block text-gray-700 text-sm font-medium mb-1">
              Last Name <span className="text-red-500">*</span>
            </label>
            <input
              type="text"
              placeholder="Enter your last name"
              required
              className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            />
          </div>

          <div>
            <label className="block text-gray-700 text-sm font-medium mb-1">
              Father Name <span className="text-red-500">*</span>
            </label>
            <input
              type="text"
              placeholder="Enter your father name"
              required
              className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            />
          </div>

          <div>
            <label className="block text-gray-700 text-sm font-medium mb-1">
              Email address <span className="text-red-500">*</span>
            </label>
            <input
              type="email"
              placeholder="Enter your email"
              required
              className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            />
          </div>

          <div>
            <label className="block text-gray-700 text-sm font-medium mb-1">
              Phone Number <span className="text-red-500">*</span>
            </label>
            <input
              type="text"
              placeholder="Enter your phone number"
              required
              className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
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
              className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            />
          </div>

          <div>
            <label className="block text-gray-700 text-sm font-medium mb-1">
              Confirm Password <span className="text-red-500">*</span>
            </label>
            <input
              type="password"
              placeholder="Confirm your password"
              required
              className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            />
          </div>

          <div className="md:col-span-2">
            <button
              type="submit"
              className="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 rounded-lg transition duration-200"
            >
              Register
            </button>
          </div>
        </form>

        {/* Footer */}
        <div className="text-center mt-4 text-sm text-gray-600">
          Already have an account?{" "}
          <Link
            to="/login"
            className="text-teal-600 hover:underline font-medium"
          >
            Sign In
          </Link>
        </div>
      </div>
    </div>
  );
}
