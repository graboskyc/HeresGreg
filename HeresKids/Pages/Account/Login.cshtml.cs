using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using Microsoft.AspNetCore.Identity;
using AspNetCore.Identity.Mongo.Model;
using System.Threading.Tasks;

namespace HeresKids.Pages.Account
{
    public class LoginModel : PageModel
    {
        private readonly SignInManager<MongoUser> _signInManager;

        public LoginModel(SignInManager<MongoUser> signInManager)
        {
            _signInManager = signInManager;
        }

        [BindProperty]
        public string Email { get; set; } = "";
        [BindProperty]
        public string Password { get; set; } = "";
        public bool IsLoading { get; set; } = false;
        public string ErrorMessage { get; set; } = "";

        public void OnGet()
        {
            // Initial page load
        }

        public async Task<IActionResult> OnPostAsync()
        {
            IsLoading = true;
            ErrorMessage = "";
            var result = await _signInManager.PasswordSignInAsync(Email, Password, isPersistent: true, lockoutOnFailure: false);
            IsLoading = false;
            if (result.Succeeded)
            {
                Console.WriteLine("User logged in successfully.");
                return Redirect("/Vids");
            }
            else
            {
                Console.WriteLine("Login failed for user: " + Email);
                ErrorMessage = "Invalid login attempt.";
                return Page();
            }
        }
    }
}
