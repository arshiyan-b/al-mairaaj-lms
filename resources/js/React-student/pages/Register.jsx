import React, { useState } from "react";
import { Link } from "react-router-dom";
import image from "../assests/logo.png";

export default function Register() {
  // Get Laravel route + CSRF token from Blade
  const appDiv = document.getElementById("app");
  const registerRoute = `${appDiv.dataset.registerRoute}`;
  const csrfToken = appDiv.dataset.csrf;

  const [formData, setFormData] = useState({
    first_name: "",
    middle_name: "",
    last_name: "",
    father_name: "",
    email: "",
    phone: "",
    password: "",
    password_confirmation: "",
  });

  const [errorMsg, setErrorMsg] = useState("");
  const [successMsg, setSuccessMsg] = useState("");
  const [loading, setLoading] = useState(false);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prev) => ({ ...prev, [name]: value }));
  };

  const handleRegister = async (e) => {
    e.preventDefault();
    setLoading(true);
    setErrorMsg("");
    setSuccessMsg("");

    try {
      const response = await fetch(registerRoute, {
        method: "POST",
        headers: {
          "Accept": "application/json",
          "Content-Type": "application/json",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": csrfToken,
        },
        credentials: "include",
        body: JSON.stringify(formData),
      });

      const data = await response.json();

      if (!response.ok) {
        setErrorMsg(data.message || "Registration failed. Please try again.");
      } else {
        setSuccessMsg("Registration successful!");
        setFormData({
          first_name: "",
          middle_name: "",
          last_name: "",
          father_name: "",
          email: "",
          phone: "",
          password: "",
          password_confirmation: "",
        });
      }
    } catch (error) {
      console.error("Network error:", error);
      setErrorMsg("Network error. Please try again.");
    } finally {
      setLoading(false);
    }

  };

  return (
    <div className="min-h-screen flex items-center justify-center bg-gradient-to-br from-teal-300 to-teal-500 p-6">
      <div className="bg-white shadow-lg rounded-xl w-full max-w-3xl p-8 md:p-10 mx-4">
        {/* Logo Section */}
        <div className="flex flex-col items-center mb-6">
          <img src={image} alt="AL Mairaaj" className="w-40 h-auto mb-2" />
          <h2 className="text-xl font-semibold">Student Registration Form</h2>
          <p className="text-sm text-gray-500 mt-1 text-center">
            Enter your information to create an account.
          </p>
        </div>

        {/* Feedback */}
        {errorMsg && <div className="text-red-500 text-center mb-4">{errorMsg}</div>}
        {successMsg && <div className="text-green-600 text-center mb-4">{successMsg}</div>}

        {/* Registration Form */}
        <form onSubmit={handleRegister} className="grid grid-cols-1 md:grid-cols-2 gap-5">
          {[
            { name: "first_name", label: "First Name", required: true },
            { name: "middle_name", label: "Middle Name" },
            { name: "last_name", label: "Last Name", required: true },
            { name: "father_name", label: "Father Name", required: true },
            { name: "email", label: "Email address", type: "email", required: true },
            { name: "phone", label: "Phone Number", required: true },
            { name: "password", label: "Password", type: "password", required: true },
            { name: "password_confirmation", label: "Confirm Password", type: "password", required: true },
          ].map((field, i) => (
            <div key={i}>
              <label className="block text-gray-700 text-sm font-medium mb-1">
                {field.label} {field.required && <span className="text-red-500">*</span>}
              </label>
              <input
                name={field.name}
                type={field.type || "text"}
                placeholder={`Enter your ${field.label.toLowerCase()}`}
                required={field.required}
                value={formData[field.name]}
                onChange={handleChange}
                className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
              />
            </div>
          ))}

          <div className="md:col-span-2">
            <button
              type="submit"
              disabled={loading}
              className="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 rounded-lg transition duration-200 disabled:opacity-60"
            >
              {loading ? "Registering..." : "Register"}
            </button>
          </div>
        </form>

        {/* Footer */}
        <div className="text-center mt-4 text-sm text-gray-600">
          Already have an account?{" "}
          <Link to="/login" className="text-teal-600 hover:underline font-medium">
            Sign In
          </Link>
        </div>
      </div>
    </div>
  );
}
