package com.lib_testing;

import java.io.IOException;
import java.util.concurrent.TimeUnit;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.support.ui.Select;
import org.testng.Assert;
import org.testng.annotations.AfterSuite;
import org.testng.annotations.AfterTest;
import org.testng.annotations.BeforeMethod;
import org.testng.annotations.BeforeSuite;
import org.testng.annotations.Test;

import com.aventstack.extentreports.ExtentReports;
import com.aventstack.extentreports.ExtentTest;
import com.aventstack.extentreports.MediaEntityBuilder;
import com.aventstack.extentreports.Status;
import com.aventstack.extentreports.reporter.ExtentHtmlReporter;

public class ExtentDemo {
	ExtentHtmlReporter htmlReporter;
	ExtentReports extent;
	WebDriver driver;

	@BeforeSuite
	public void setup() {
		System.setProperty("webdriver.chrome.driver", ".\\drivers\\chromedriver.exe");
		driver = new ChromeDriver();
		htmlReporter = new ExtentHtmlReporter("extent.html");
		extent = new ExtentReports();
		extent.attachReporter(htmlReporter);
	}

	/*
	 * @BeforeMethod public void methodSetUp() {
	 * driver.manage().timeouts().pageLoadTimeout(50, TimeUnit.SECONDS);
	 * driver.manage().timeouts().implicitlyWait(20, TimeUnit.SECONDS); }
	 */

	/*
	 * @Test public void test1() throws IOException { ExtentTest test =
	 * extent.createTest("MyFirstTest", "Sample description"); // log(Status,
	 * details) test.log(Status.INFO,
	 * "This step shows usage of log(status, details)");
	 * 
	 * // info(details) test.info("This step shows usage of info(details)");
	 * 
	 * // log with snapshot test.fail("details",
	 * MediaEntityBuilder.createScreenCaptureFromPath("screenshot.png").build());
	 * 
	 * // test with snapshot test.addScreenCaptureFromPath("screenshot.png"); }
	 */

	@Test
	public void Register() {
		extent.createTest("Student Registration Test", "testing Student Registration functionality");
		driver.get("http://localhost/Testing_library/project/student/login.php");

		driver.findElement(
				By.xpath("/html//section[@class='login_content']/form[@name='form1']//a[@href='registration.php']"))
				.click();
	
		driver.findElement(By.name("name")).sendKeys("tester");
		driver.findElement(By.name("uname")).sendKeys("tester");
		driver.findElement(By.name("psw")).sendKeys("tester");
		driver.findElement(By.name("email")).sendKeys("tester@gmail.com");
		driver.findElement(By.name("phone")).sendKeys("7896541235");
		driver.findElement(By.name("sem")).sendKeys("5");
		driver.findElement(By.name("eno")).sendKeys("500");

		driver.findElement(By.name("sub")).click();

		String at = driver
				.findElement(
						By.xpath("//body[@class='login']//div[@class='alert alert-success col-lg-6 col-lg-push-3']"))
				.getText();
		String et = "Registration Succesful";

		if (at.equalsIgnoreCase(et)) {
			System.out.println("Test Successful");
			Assert.assertTrue(true);
		} else {
			System.out.println("Test UnSuccessful");
			Assert.assertTrue(false);
		}

	
	}
	
	@Test
	public void bookIsuueTest() {
		extent.createTest("Book_Issue Test", "testing Book Issue Functionality");
		driver.get("http://localhost/Testing_library/project/librarian/adminlogin.php");
		driver.findElement(By.name("un")).sendKeys("admin");
		driver.findElement(By.name("pass")).sendKeys("admin");
		driver.findElement(By.name("sub")).click();
		driver.findElement(
				By.xpath("//div[@id='sidebar-menu']//ul[@class='nav side-menu']//a[@href='issue_books.php']")).click();
		
		Select drop1 = new Select(driver.findElement(By.xpath("/html//select[@id='ee']")));
		drop1.selectByIndex(1);

		driver.findElement(By.xpath(
				"/html/body[@class='nav-md']//div[@role='main']//div[@class='row']//form[@name='f1']/button[@name='sub']"))
				.click();
		Select drop2 = new Select(
				driver.findElement(By.xpath("//div[@id='issuebox']/form[@name='sform']/select[@id='ee']")));
		drop2.selectByIndex(1);
		driver.findElement(By.xpath("//div[@id='issuebox']/form[@name='sform']/button[@name='sub2']")).click();

		String at = driver
				.findElement(By.xpath("//div[@id='issuebox']/div[@class='alert alert-success col-lg-6 col-lg-push-3']"))
				.getText();
		String et = "Book Issued successfully!!";

		if (at.equalsIgnoreCase(et)) {
			System.out.println("Test Successful");
			Assert.assertTrue(true);
		} else {
			System.out.println("Test UnSuccessful");
			Assert.assertTrue(false);
		}

		
	}


	@Test
	public void loginTest() {
		extent.createTest("Login Test1", "test login by providing correct username and password");
		driver.get("http://localhost/Testing_library/project/student/login.php");
		driver.manage().window().maximize();
		driver.findElement(By.name("un")).sendKeys("sankar");
		driver.findElement(By.name("pass")).sendKeys("sankar");
		driver.findElement(By.name("sub")).click();
		
		String at = driver.getTitle();
		String et = "Issued_books";

		if (at.equalsIgnoreCase(et)) {
			System.out.println("Test Successful");
			Assert.assertTrue(true);
		} else {
			System.out.println("Test UnSuccessful");
			Assert.assertTrue(false);
		}

	}

	@Test
	public void incorrectUsernameTest() {
		extent.createTest("Login Test 2", "test login by providing incorrect username and correct password");
		driver.get("http://localhost/Testing_library/project/student/login.php");
		driver.findElement(By.name("un")).sendKeys("sankereee");
		driver.findElement(By.name("pass")).sendKeys("sankar");
		driver.findElement(By.name("sub")).click();
		sleep(3000);

		String at = driver.findElement(By.xpath("/html//div[@class='alert alert-danger col-lg-6 col-lg-push-3']"))
				.getText();
		String et = "Invalid Username Or Password.";

		if (at.equalsIgnoreCase(et)) {
			System.out.println("Test Successful");
		} else {
			System.out.println("Test UnSuccessful");
		}
	}

	@Test
	public void incorrectPasswordTest() {
		extent.createTest("Login Test 3", "testing login by providing incorrect password and correct username");
		driver.get("http://localhost/Testing_library/project/student/login.php");
		driver.findElement(By.name("un")).sendKeys("sankar");
		driver.findElement(By.name("pass")).sendKeys("sankare");
		driver.findElement(By.name("sub")).click();
		

		String at = driver.findElement(By.xpath("/html//div[@class='alert alert-danger col-lg-6 col-lg-push-3']"))
				.getText();
		String et = "Invalid Username Or Password.";

		if (at.equalsIgnoreCase(et)) {
			System.out.println("Test Successful");
		} else {
			System.out.println("Test UnSuccessful");
		}
	}

	@Test
	public void bothIncorrectTest() {
		extent.createTest("Login Test 4", "testing login by providing both uncorrect username and password");
		driver.get("http://localhost/Testing_library/project/student/login.php");
		driver.findElement(By.name("un")).sendKeys("sankarmanu");
		driver.findElement(By.name("pass")).sendKeys("sankare");
		driver.findElement(By.name("sub")).click();
	

		String at = driver.findElement(By.xpath("/html//div[@class='alert alert-danger col-lg-6 col-lg-push-3']"))
				.getText();
		String et = "Invalid Username Or Password.";

		if (at.equalsIgnoreCase(et)) {
			System.out.println("Test Successful");
		} else {
			System.out.println("Test UnSuccessful");
		}
	}

	@Test
	public void Logout() {
		extent.createTest("Logout Test", "testing logout functionality");
		driver.get("http://localhost/Testing_library/project/student/login.php");

		driver.findElement(By.name("un")).sendKeys("sankar");
		driver.findElement(By.name("pass")).sendKeys("sankar");
		driver.findElement(By.name("sub")).click();
		

		driver.findElement(By.xpath(
				"/html/body[@class='nav-md']//nav/ul[@class='nav navbar-nav navbar-right']/li[1]/a[@href='javascript:;']"))
				.click();
		
		driver.findElement(By.xpath(
				"/html/body[@class='nav-md']//nav/ul[@class='nav navbar-nav navbar-right']//ul[@class='dropdown-menu dropdown-usermenu pull-right']//a[@href='s_logout.php']"))
				.click();
		
		driver.get("http://localhost/Testing_library/project/student/my_issued_books.php");
		String at = driver.getTitle();
		String et = "student login";

		if (at.equalsIgnoreCase(et)) {
			System.out.println("Test Successful");
		} else {
			System.out.println("Test UnSuccessful");
		}

	}

	@AfterTest
	public void tearDownTest() {
		driver.close();
		driver.quit();
	}

	@AfterSuite
	public void tearDown() {
		extent.flush();
	}

	private void sleep(long m) {
		try {
			Thread.sleep(m);
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
}
