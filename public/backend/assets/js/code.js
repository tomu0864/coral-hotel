// Delete Tean Member
$(function () {
    $(document).on("submit", ".deleteTeam", function (e) {
        e.preventDefault(); // Prevent default form submission

        const deleteForm = $(this);

        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            input: "password", // Prompt for password
            inputPlaceholder: "Enter your password",
            inputAttributes: {
                autocapitalize: "off",
                autocorrect: "off",
            },
            inputValidator: (value) => {
                if (!value) {
                    return "You need to enter your password!";
                }
            },
            focusConfirm: false, // Do not focus on the confirm button initially
        }).then((result) => {
            if (result.isConfirmed) {
                const password = result.value;
                const csrfToken = $('meta[name="csrf-token"]').attr("content"); // Get CSRF token

                // Proceed with form submission (DELETE request via AJAX)
                $.ajax({
                    url: deleteForm.attr("action"),
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: csrfToken, // Include CSRF token
                        password: password, // Include entered password in data
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "The team member has been deleted.",
                                icon: "success",
                            }).then(() => {
                                location.reload(); // Reload page or perform additional actions
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text:
                                    response.message ||
                                    "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 403) {
                            Swal.fire({
                                title: "Error!",
                                text: "Incorrect password. Please try again.",
                                icon: "error",
                                showCancelButton: true,
                                cancelButtonText: "Cancel",
                                confirmButtonText: "Try Again",
                                showLoaderOnConfirm: true,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Re-prompt for password on "Try Again"
                                    deleteForm.submit();
                                }
                            });
                        } else {
                            console.error(xhr.responseText); // Log detailed error message to console
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    });
});

// Delete Room Number
$(function () {
    $(document).on("submit", ".deleteRoomNumber", function (e) {
        e.preventDefault(); // Prevent default form submission

        const deleteForm = $(this);

        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            input: "password", // Prompt for password
            inputPlaceholder: "Enter your password",
            inputAttributes: {
                autocapitalize: "off",
                autocorrect: "off",
            },
            inputValidator: (value) => {
                if (!value) {
                    return "You need to enter your password!";
                }
            },
            focusConfirm: false, // Do not focus on the confirm button initially
        }).then((result) => {
            if (result.isConfirmed) {
                const password = result.value;
                const csrfToken = $('meta[name="csrf-token"]').attr("content"); // Get CSRF token

                // Proceed with form submission (DELETE request via AJAX)
                $.ajax({
                    url: deleteForm.attr("action"),
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: csrfToken, // Include CSRF token
                        password: password, // Include entered password in data
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "The room number has been deleted.",
                                icon: "success",
                            }).then(() => {
                                location.reload(); // Reload page or perform additional actions
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text:
                                    response.message ||
                                    "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 403) {
                            Swal.fire({
                                title: "Error!",
                                text: "Incorrect password. Please try again.",
                                icon: "error",
                                showCancelButton: true,
                                cancelButtonText: "Cancel",
                                confirmButtonText: "Try Again",
                                showLoaderOnConfirm: true,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Re-prompt for password on "Try Again"
                                    deleteForm.submit();
                                }
                            });
                        } else {
                            console.error(xhr.responseText); // Log detailed error message to console
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    });
});

// Delete Room
$(function () {
    $(document).on("submit", ".deleteRoom", function (e) {
        e.preventDefault(); // Prevent default form submission

        const deleteForm = $(this);

        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            input: "password", // Prompt for password
            inputPlaceholder: "Enter your password",
            inputAttributes: {
                autocapitalize: "off",
                autocorrect: "off",
            },
            inputValidator: (value) => {
                if (!value) {
                    return "You need to enter your password!";
                }
            },
            focusConfirm: false, // Do not focus on the confirm button initially
        }).then((result) => {
            if (result.isConfirmed) {
                const password = result.value;
                const csrfToken = $('meta[name="csrf-token"]').attr("content"); // Get CSRF token

                // Proceed with form submission (DELETE request via AJAX)
                $.ajax({
                    url: deleteForm.attr("action"),
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: csrfToken, // Include CSRF token
                        password: password, // Include entered password in data
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "The room has been deleted.",
                                icon: "success",
                            }).then(() => {
                                location.reload(); // Reload page or perform additional actions
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text:
                                    response.message ||
                                    "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 403) {
                            Swal.fire({
                                title: "Error!",
                                text: "Incorrect password. Please try again.",
                                icon: "error",
                                showCancelButton: true,
                                cancelButtonText: "Cancel",
                                confirmButtonText: "Try Again",
                                showLoaderOnConfirm: true,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Re-prompt for password on "Try Again"
                                    deleteForm.submit();
                                }
                            });
                        } else {
                            console.error(xhr.responseText); // Log detailed error message to console
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    });
});

// Delete Facility
$(function () {
    $(document).on("submit", ".deleteFacility", function (e) {
        e.preventDefault(); // Prevent default form submission

        const deleteForm = $(this);

        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            input: "password", // Prompt for password
            inputPlaceholder: "Enter your password",
            inputAttributes: {
                autocapitalize: "off",
                autocorrect: "off",
            },
            inputValidator: (value) => {
                if (!value) {
                    return "You need to enter your password!";
                }
            },
            focusConfirm: false, // Do not focus on the confirm button initially
        }).then((result) => {
            if (result.isConfirmed) {
                const password = result.value;
                const csrfToken = $('meta[name="csrf-token"]').attr("content"); // Get CSRF token

                // Proceed with form submission (DELETE request via AJAX)
                $.ajax({
                    url: deleteForm.attr("action"),
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: csrfToken, // Include CSRF token
                        password: password, // Include entered password in data
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "The facility has been deleted.",
                                icon: "success",
                            }).then(() => {
                                location.reload(); // Reload page or perform additional actions
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text:
                                    response.message ||
                                    "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 403) {
                            Swal.fire({
                                title: "Error!",
                                text: "Incorrect password. Please try again.",
                                icon: "error",
                                showCancelButton: true,
                                cancelButtonText: "Cancel",
                                confirmButtonText: "Try Again",
                                showLoaderOnConfirm: true,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Re-prompt for password on "Try Again"
                                    deleteForm.submit();
                                }
                            });
                        } else {
                            console.error(xhr.responseText); // Log detailed error message to console
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    });
});
// Delete Assigned room from booking_list table
$(function () {
    $(document).on("submit", ".deleteAssignRoom", function (e) {
        e.preventDefault(); // Prevent default form submission

        const deleteForm = $(this);

        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            input: "password", // Prompt for password
            inputPlaceholder: "Enter your password",
            inputAttributes: {
                autocapitalize: "off",
                autocorrect: "off",
            },
            inputValidator: (value) => {
                if (!value) {
                    return "You need to enter your password!";
                }
            },
            focusConfirm: false, // Do not focus on the confirm button initially
        }).then((result) => {
            if (result.isConfirmed) {
                const password = result.value;
                const csrfToken = $('meta[name="csrf-token"]').attr("content"); // Get CSRF token

                // Proceed with form submission (DELETE request via AJAX)
                $.ajax({
                    url: deleteForm.attr("action"),
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: csrfToken, // Include CSRF token
                        password: password, // Include entered password in data
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "The assigned room has been deleted.",
                                icon: "success",
                            }).then(() => {
                                location.reload(); // Reload page or perform additional actions
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text:
                                    response.message ||
                                    "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 403) {
                            Swal.fire({
                                title: "Error!",
                                text: "Incorrect password. Please try again.",
                                icon: "error",
                                showCancelButton: true,
                                cancelButtonText: "Cancel",
                                confirmButtonText: "Try Again",
                                showLoaderOnConfirm: true,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Re-prompt for password on "Try Again"
                                    deleteForm.submit();
                                }
                            });
                        } else {
                            console.error(xhr.responseText); // Log detailed error message to console
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    });
});

// Delete testimonial
$(function () {
    $(document).on("submit", ".deleteTestimonial", function (e) {
        e.preventDefault(); // Prevent default form submission

        const deleteForm = $(this);

        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            input: "password", // Prompt for password
            inputPlaceholder: "Enter your password",
            inputAttributes: {
                autocapitalize: "off",
                autocorrect: "off",
            },
            inputValidator: (value) => {
                if (!value) {
                    return "You need to enter your password!";
                }
            },
            focusConfirm: false, // Do not focus on the confirm button initially
        }).then((result) => {
            if (result.isConfirmed) {
                const password = result.value;
                const csrfToken = $('meta[name="csrf-token"]').attr("content"); // Get CSRF token

                // Proceed with form submission (DELETE request via AJAX)
                $.ajax({
                    url: deleteForm.attr("action"),
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: csrfToken, // Include CSRF token
                        password: password, // Include entered password in data
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "The testimonial has been deleted.",
                                icon: "success",
                            }).then(() => {
                                location.reload(); // Reload page or perform additional actions
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text:
                                    response.message ||
                                    "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 403) {
                            Swal.fire({
                                title: "Error!",
                                text: "Incorrect password. Please try again.",
                                icon: "error",
                                showCancelButton: true,
                                cancelButtonText: "Cancel",
                                confirmButtonText: "Try Again",
                                showLoaderOnConfirm: true,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Re-prompt for password on "Try Again"
                                    deleteForm.submit();
                                }
                            });
                        } else {
                            console.error(xhr.responseText); // Log detailed error message to console
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    });
});

// Delete Blog Category
$(function () {
    $(document).on("submit", ".deleteBlogCategory", function (e) {
        e.preventDefault(); // Prevent default form submission

        const deleteForm = $(this);

        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            input: "password", // Prompt for password
            inputPlaceholder: "Enter your password",
            inputAttributes: {
                autocapitalize: "off",
                autocorrect: "off",
            },
            inputValidator: (value) => {
                if (!value) {
                    return "You need to enter your password!";
                }
            },
            focusConfirm: false, // Do not focus on the confirm button initially
        }).then((result) => {
            if (result.isConfirmed) {
                const password = result.value;
                const csrfToken = $('meta[name="csrf-token"]').attr("content"); // Get CSRF token

                // Proceed with form submission (DELETE request via AJAX)
                $.ajax({
                    url: deleteForm.attr("action"),
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: csrfToken, // Include CSRF token
                        password: password, // Include entered password in data
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "The Blog category has been deleted.",
                                icon: "success",
                            }).then(() => {
                                location.reload(); // Reload page or perform additional actions
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text:
                                    response.message ||
                                    "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 403) {
                            Swal.fire({
                                title: "Error!",
                                text: "Incorrect password. Please try again.",
                                icon: "error",
                                showCancelButton: true,
                                cancelButtonText: "Cancel",
                                confirmButtonText: "Try Again",
                                showLoaderOnConfirm: true,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Re-prompt for password on "Try Again"
                                    deleteForm.submit();
                                }
                            });
                        } else {
                            console.error(xhr.responseText); // Log detailed error message to console
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    });
});

// Delete Blog Post
$(function () {
    $(document).on("submit", ".deleteBlogPost", function (e) {
        e.preventDefault(); // Prevent default form submission

        const deleteForm = $(this);

        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            input: "password", // Prompt for password
            inputPlaceholder: "Enter your password",
            inputAttributes: {
                autocapitalize: "off",
                autocorrect: "off",
            },
            inputValidator: (value) => {
                if (!value) {
                    return "You need to enter your password!";
                }
            },
            focusConfirm: false, // Do not focus on the confirm button initially
        }).then((result) => {
            if (result.isConfirmed) {
                const password = result.value;
                const csrfToken = $('meta[name="csrf-token"]').attr("content"); // Get CSRF token

                // Proceed with form submission (DELETE request via AJAX)
                $.ajax({
                    url: deleteForm.attr("action"),
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: csrfToken, // Include CSRF token
                        password: password, // Include entered password in data
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "The Blog post has been deleted.",
                                icon: "success",
                            }).then(() => {
                                location.reload(); // Reload page or perform additional actions
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text:
                                    response.message ||
                                    "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 403) {
                            Swal.fire({
                                title: "Error!",
                                text: "Incorrect password. Please try again.",
                                icon: "error",
                                showCancelButton: true,
                                cancelButtonText: "Cancel",
                                confirmButtonText: "Try Again",
                                showLoaderOnConfirm: true,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Re-prompt for password on "Try Again"
                                    deleteForm.submit();
                                }
                            });
                        } else {
                            console.error(xhr.responseText); // Log detailed error message to console
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    });
});

// Delete FAQ
$(function () {
    $(document).on("submit", ".deleteFaq", function (e) {
        e.preventDefault(); // Prevent default form submission

        const deleteForm = $(this);

        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            input: "password", // Prompt for password
            inputPlaceholder: "Enter your password",
            inputAttributes: {
                autocapitalize: "off",
                autocorrect: "off",
            },
            inputValidator: (value) => {
                if (!value) {
                    return "You need to enter your password!";
                }
            },
            focusConfirm: false, // Do not focus on the confirm button initially
        }).then((result) => {
            if (result.isConfirmed) {
                const password = result.value;
                const csrfToken = $('meta[name="csrf-token"]').attr("content"); // Get CSRF token

                // Proceed with form submission (DELETE request via AJAX)
                $.ajax({
                    url: deleteForm.attr("action"),
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: csrfToken, // Include CSRF token
                        password: password, // Include entered password in data
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "The FAQ has been deleted.",
                                icon: "success",
                            }).then(() => {
                                location.reload(); // Reload page or perform additional actions
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text:
                                    response.message ||
                                    "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 403) {
                            Swal.fire({
                                title: "Error!",
                                text: "Incorrect password. Please try again.",
                                icon: "error",
                                showCancelButton: true,
                                cancelButtonText: "Cancel",
                                confirmButtonText: "Try Again",
                                showLoaderOnConfirm: true,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Re-prompt for password on "Try Again"
                                    deleteForm.submit();
                                }
                            });
                        } else {
                            console.error(xhr.responseText); // Log detailed error message to console
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    });
});

// Delete Restaurant Category
$(function () {
    $(document).on("submit", ".deleteRestaurantCat", function (e) {
        e.preventDefault(); // Prevent default form submission

        const deleteForm = $(this);

        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            input: "password", // Prompt for password
            inputPlaceholder: "Enter your password",
            inputAttributes: {
                autocapitalize: "off",
                autocorrect: "off",
            },
            inputValidator: (value) => {
                if (!value) {
                    return "You need to enter your password!";
                }
            },
            focusConfirm: false, // Do not focus on the confirm button initially
        }).then((result) => {
            if (result.isConfirmed) {
                const password = result.value;
                const csrfToken = $('meta[name="csrf-token"]').attr("content"); // Get CSRF token

                // Proceed with form submission (DELETE request via AJAX)
                $.ajax({
                    url: deleteForm.attr("action"),
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: csrfToken, // Include CSRF token
                        password: password, // Include entered password in data
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Restaurant category has been deleted.",
                                icon: "success",
                            }).then(() => {
                                location.reload(); // Reload page or perform additional actions
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text:
                                    response.message ||
                                    "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 403) {
                            Swal.fire({
                                title: "Error!",
                                text: "Incorrect password. Please try again.",
                                icon: "error",
                                showCancelButton: true,
                                cancelButtonText: "Cancel",
                                confirmButtonText: "Try Again",
                                showLoaderOnConfirm: true,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Re-prompt for password on "Try Again"
                                    deleteForm.submit();
                                }
                            });
                        } else {
                            console.error(xhr.responseText); // Log detailed error message to console
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    });
});

// Delete Booking
$(function () {
    $(document).on("submit", ".deleteBooking", function (e) {
        e.preventDefault(); // Prevent default form submission

        const deleteForm = $(this);

        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            input: "password", // Prompt for password
            inputPlaceholder: "Enter your password",
            inputAttributes: {
                autocapitalize: "off",
                autocorrect: "off",
            },
            inputValidator: (value) => {
                if (!value) {
                    return "You need to enter your password!";
                }
            },
            focusConfirm: false, // Do not focus on the confirm button initially
        }).then((result) => {
            if (result.isConfirmed) {
                const password = result.value;
                const csrfToken = $('meta[name="csrf-token"]').attr("content"); // Get CSRF token

                // Proceed with form submission (DELETE request via AJAX)
                $.ajax({
                    url: deleteForm.attr("action"),
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: csrfToken, // Include CSRF token
                        password: password, // Include entered password in data
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Booking has been canceled successfully",
                                icon: "success",
                            }).then(() => {
                                location.reload(); // Reload page or perform additional actions
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text:
                                    response.message ||
                                    "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 403) {
                            Swal.fire({
                                title: "Error!",
                                text: "Incorrect password. Please try again.",
                                icon: "error",
                                showCancelButton: true,
                                cancelButtonText: "Cancel",
                                confirmButtonText: "Try Again",
                                showLoaderOnConfirm: true,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Re-prompt for password on "Try Again"
                                    deleteForm.submit();
                                }
                            });
                        } else {
                            console.error(xhr.responseText); // Log detailed error message to console
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    });
});

// Delete Permission
$(function () {
    $(document).on("submit", ".deletePermission", function (e) {
        e.preventDefault(); // Prevent default form submission

        const deleteForm = $(this);

        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            input: "password", // Prompt for password
            inputPlaceholder: "Enter your password",
            inputAttributes: {
                autocapitalize: "off",
                autocorrect: "off",
            },
            inputValidator: (value) => {
                if (!value) {
                    return "You need to enter your password!";
                }
            },
            focusConfirm: false, // Do not focus on the confirm button initially
        }).then((result) => {
            if (result.isConfirmed) {
                const password = result.value;
                const csrfToken = $('meta[name="csrf-token"]').attr("content"); // Get CSRF token

                // Proceed with form submission (DELETE request via AJAX)
                $.ajax({
                    url: deleteForm.attr("action"),
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: csrfToken, // Include CSRF token
                        password: password, // Include entered password in data
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Permission has been deleted successfully",
                                icon: "success",
                            }).then(() => {
                                location.reload(); // Reload page or perform additional actions
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text:
                                    response.message ||
                                    "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 403) {
                            Swal.fire({
                                title: "Error!",
                                text: "Incorrect password. Please try again.",
                                icon: "error",
                                showCancelButton: true,
                                cancelButtonText: "Cancel",
                                confirmButtonText: "Try Again",
                                showLoaderOnConfirm: true,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Re-prompt for password on "Try Again"
                                    deleteForm.submit();
                                }
                            });
                        } else {
                            console.error(xhr.responseText); // Log detailed error message to console
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    });
});

// Delete Permission
$(function () {
    $(document).on("submit", ".deleteRole", function (e) {
        e.preventDefault(); // Prevent default form submission

        const deleteForm = $(this);

        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            input: "password", // Prompt for password
            inputPlaceholder: "Enter your password",
            inputAttributes: {
                autocapitalize: "off",
                autocorrect: "off",
            },
            inputValidator: (value) => {
                if (!value) {
                    return "You need to enter your password!";
                }
            },
            focusConfirm: false, // Do not focus on the confirm button initially
        }).then((result) => {
            if (result.isConfirmed) {
                const password = result.value;
                const csrfToken = $('meta[name="csrf-token"]').attr("content"); // Get CSRF token

                // Proceed with form submission (DELETE request via AJAX)
                $.ajax({
                    url: deleteForm.attr("action"),
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: csrfToken, // Include CSRF token
                        password: password, // Include entered password in data
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Role has been deleted successfully",
                                icon: "success",
                            }).then(() => {
                                location.reload(); // Reload page or perform additional actions
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text:
                                    response.message ||
                                    "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 403) {
                            Swal.fire({
                                title: "Error!",
                                text: "Incorrect password. Please try again.",
                                icon: "error",
                                showCancelButton: true,
                                cancelButtonText: "Cancel",
                                confirmButtonText: "Try Again",
                                showLoaderOnConfirm: true,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Re-prompt for password on "Try Again"
                                    deleteForm.submit();
                                }
                            });
                        } else {
                            console.error(xhr.responseText); // Log detailed error message to console
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    });
});

// Delete Roles in Permission
$(function () {
    $(document).on("submit", ".deleteRoleAssign", function (e) {
        e.preventDefault(); // Prevent default form submission

        const deleteForm = $(this);

        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            input: "password", // Prompt for password
            inputPlaceholder: "Enter your password",
            inputAttributes: {
                autocapitalize: "off",
                autocorrect: "off",
            },
            inputValidator: (value) => {
                if (!value) {
                    return "You need to enter your password!";
                }
            },
            focusConfirm: false, // Do not focus on the confirm button initially
        }).then((result) => {
            if (result.isConfirmed) {
                const password = result.value;
                const csrfToken = $('meta[name="csrf-token"]').attr("content"); // Get CSRF token

                // Proceed with form submission (DELETE request via AJAX)
                $.ajax({
                    url: deleteForm.attr("action"),
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: csrfToken, // Include CSRF token
                        password: password, // Include entered password in data
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Role in permission has been deleted successfully",
                                icon: "success",
                            }).then(() => {
                                location.reload(); // Reload page or perform additional actions
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text:
                                    response.message ||
                                    "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 403) {
                            Swal.fire({
                                title: "Error!",
                                text: "Incorrect password. Please try again.",
                                icon: "error",
                                showCancelButton: true,
                                cancelButtonText: "Cancel",
                                confirmButtonText: "Try Again",
                                showLoaderOnConfirm: true,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Re-prompt for password on "Try Again"
                                    deleteForm.submit();
                                }
                            });
                        } else {
                            console.error(xhr.responseText); // Log detailed error message to console
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    });
});

// Delete Admin User
$(function () {
    $(document).on("submit", ".deleteAdmin", function (e) {
        e.preventDefault(); // Prevent default form submission

        const deleteForm = $(this);

        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            input: "password", // Prompt for password
            inputPlaceholder: "Enter your password",
            inputAttributes: {
                autocapitalize: "off",
                autocorrect: "off",
            },
            inputValidator: (value) => {
                if (!value) {
                    return "You need to enter your password!";
                }
            },
            focusConfirm: false, // Do not focus on the confirm button initially
        }).then((result) => {
            if (result.isConfirmed) {
                const password = result.value;
                const csrfToken = $('meta[name="csrf-token"]').attr("content"); // Get CSRF token

                // Proceed with form submission (DELETE request via AJAX)
                $.ajax({
                    url: deleteForm.attr("action"),
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: csrfToken, // Include CSRF token
                        password: password, // Include entered password in data
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Admin user has been deleted successfully",
                                icon: "success",
                            }).then(() => {
                                location.reload(); // Reload page or perform additional actions
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text:
                                    response.message ||
                                    "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 403) {
                            Swal.fire({
                                title: "Error!",
                                text: "Incorrect password. Please try again.",
                                icon: "error",
                                showCancelButton: true,
                                cancelButtonText: "Cancel",
                                confirmButtonText: "Try Again",
                                showLoaderOnConfirm: true,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Re-prompt for password on "Try Again"
                                    deleteForm.submit();
                                }
                            });
                        } else {
                            console.error(xhr.responseText); // Log detailed error message to console
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to delete data. Please try again later.",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    });
});
