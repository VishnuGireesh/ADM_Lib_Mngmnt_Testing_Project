package com.lib_testing;

import java.util.concurrent.TimeUnit;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.testng.annotations.AfterMethod;
import org.testng.annotations.BeforeMethod;
import org.testng.annotations.Test;

public class Demo {
	WebDriver driver;

	@BeforeMethod
	public void setUp() {
		System.setProperty("webdriver.chrome.driver", ".\\drivers\\chromedriver.exe");
		driver = new ChromeDriver();
		driver.manage().timeouts().pageLoadTimeout(50, TimeUnit.SECONDS);
		driver.manage().timeouts().implicitlyWait(20, TimeUnit.SECONDS);
		driver.get("http://localhost/Testing_library/project/student/login.php");
		driver.manage().window().maximize();
	}

	@Test
	public void loginTest() {

		driver.findElement(By.name("un")).sendKeys("sankar");
		driver.findElement(By.name("pass")).sendKeys("sankar");
		driver.findElement(By.name("sub")).click();
		sleep(3000);
		String at = driver.getTitle();
		String et = "Issued_books";

		if (at.equalsIgnoreCase(et)) {
			System.out.println("Test Successful");
		} else {
			System.out.println("Test UnSuccessful");
		}

	}

	@Test
	public void incorrectUsernameTest() {
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
		driver.get("http://localhost/Testing_library/project/student/login.php");
		driver.findElement(By.name("un")).sendKeys("sankar");
		driver.findElement(By.name("pass")).sendKeys("sankare");
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
	public void bothIncorrectTest() {
		driver.get("http://localhost/Testing_library/project/student/login.php");
		driver.findElement(By.name("un")).sendKeys("sankarmanu");
		driver.findElement(By.name("pass")).sendKeys("sankare");
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

	@AfterMethod
	public void tearDown() {
		driver.quit();
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
