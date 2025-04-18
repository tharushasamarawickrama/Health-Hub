// // Toast model
// // Error message
// function errorToast(message) {
//     localStorage.setItem("toasterrorMessage", message); // Save the error message in localStorage
//     const toastContainer = document.getElementById("toast-container");
  
//     // Create a new toast element
//     const toast = document.createElement("div");
//     toast.className = "toast-message";
  
//     // Set the message and add a close button
//     toast.innerHTML = `${message}<span class="toast-close-btn" onclick="closeToast(this, 'toasterrorMessage')">✖</span>`;
  
//     // Append the toast to the container
//     toastContainer.appendChild(toast);
  
//     // Automatically remove the toast after 5 seconds
//     setTimeout(() => {
//       toast.remove();
//       localStorage.removeItem("toasterrorMessage");
//     }, 5000);
//   }
  
//   // Success message
//   function successToast(message) {
//     localStorage.setItem("toastsuccessMessage", message); // Save the success message in localStorage
//     const toastContainer = document.getElementById("toast-container");
  
//     // Create a new toast element
//     const toast = document.createElement("div");
//     toast.className = "toast-message-success";
  
//     // Set the message and add a close button
//     toast.innerHTML = `${message}<span class="toast-close-btn" onclick="closeToast(this, 'toastsuccessMessage')">✖</span>`;
  
//     // Append the toast to the container
//     toastContainer.appendChild(toast);
  
//     // Automatically remove the toast after 5 seconds
//     setTimeout(() => {
//       toast.remove();
//       localStorage.removeItem("toastsuccessMessage"); // Clear the message from localStorage after the timeout
//     }, 5000);
//   }
  
//   // Close toast function
//   function closeToast(toastElement, messageType) {
//     toastElement.parentElement.remove();
//     localStorage.removeItem(messageType); // Clear the message type (error/success) from localStorage
//   }
  
//   // Display stored toasts on page load
//   window.addEventListener("DOMContentLoaded", () => {
//     const errorMessage = localStorage.getItem("toasterrorMessage");
//     const successMessage = localStorage.getItem("toastsuccessMessage");
  
//     // Show the error toast if there's a stored error message
//     if (errorMessage) {
//       errorToast(errorMessage);
//     }
  
//     // Show the success toast if there's a stored success message
//     if (successMessage) {
//       successToast(successMessage);
//     }
//   });