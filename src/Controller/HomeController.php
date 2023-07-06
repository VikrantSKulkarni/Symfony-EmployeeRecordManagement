<?php

namespace App\Controller;

use App\Entity\Employees;
use App\Form\EmployeeFormType;
use App\Form\EmployeeEditFormType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;



class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $repo = $entityManager->getRepository(Employees::class);
        $data = $repo->findAll();
        return $this->render('frontend/index.html.twig', [
            'employees' => $data,
        ]);
    }

    #[Route('/addemployees', name: 'addemployees')]
    public function addemployees(Request $request,EntityManagerInterface $entityManager): Response
    {
        $emp = new Employees();
        $form = $this->createForm(EmployeeFormType::class, $emp);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $resume = $form->get('Resume')->getData();
            $profile = $form->get('ProfilePic')->getData();

            if($resume){
                if ($resume->getClientOriginalExtension() !== 'pdf') {
                    $this->addFlash('error', 'Please upload a PDF file for the resume.');
                    //return $this->redirectToRoute('addemployees');
                }
                $currentDateTime = new \DateTime();
                $formattedDateTime = $currentDateTime->format('Ymd_His');
                $fileName = $emp->getName() . '_' . $formattedDateTime . '.' . $resume->getClientOriginalExtension();
                $emp->setResume($fileName);
                $resume->move(
                    $this->getParameter('upload_directory'),
                    $fileName
                );
            }

            if($profile){
                if ($profile->getClientOriginalExtension() !== 'jpg') {
                    $this->addFlash('error', 'Please upload a jpg file for the profile');
                    return $this->redirectToRoute('addemployees');
                }
                $currentDateTime = new \DateTime();
                $formattedDateTime = $currentDateTime->format('Ymd_His');
                $fileName2 = $emp->getName() . '_' . $formattedDateTime . '.' . $profile->getClientOriginalExtension();
                $emp->setProfilePic($fileName2);
                $profile->move(
                    $this->getParameter('upload_directory'),
                    $fileName2
                );
            }

            $emp->setCreatedAt(new DateTime());
            $emp->setUpdateAt(new DateTime());
             
            $entityManager->persist($emp);
            $entityManager->flush(); 
            // Add flash message
            $this->addFlash('success', 'Employee registered successfully.');

        return $this->redirectToRoute('addemployees');
        }
        return $this->render('frontend/addemployees.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit($id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $repo = $entityManager->getRepository(Employees::class);
        $emp = $repo->find($id);
    
        if (!$emp) {
            throw $this->createNotFoundException('Employee not found');
        }
    
        // Store the existing resume and profile pic filenames
        $existingResume = $emp->getResume();
        $existingProfilePic = $emp->getProfilePic();
        
        $emp->setResume($existingResume);
        $emp->setProfilePic($existingProfilePic);
        
        $form = $this->createForm(EmployeeEditFormType::class, $emp);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Update the resume file if a new one is uploaded
            $resume = $form->get('Resume')->getData();
            if ($resume) {
                if ($resume->getClientOriginalExtension() !== 'pdf') {
                    $this->addFlash('error', 'Please upload a PDF file for the resume.');
                } else {
                    $currentDateTime = new \DateTime();
                    $formattedDateTime = $currentDateTime->format('Ymd_His');
                    $fileName = $emp->getName() . '_' . $formattedDateTime . '.' . $resume->getClientOriginalExtension();
                    $emp->setResume($fileName);
                    $resume->move(
                        $this->getParameter('upload_directory'),
                        $fileName
                    );
    
                    // Remove the old resume file if it exists
                    if ($existingResume) {
                        $this->removeFile($existingResume);
                    }
                }
            }
    
            // Update the profile pic if a new one is uploaded
            $profile = $form->get('ProfilePic')->getData();
            if ($profile) {
                if ($profile->getClientOriginalExtension() !== 'jpg') {
                    $this->addFlash('error', 'Please upload a JPG file for the profile.');
                } else {
                    $currentDateTime = new \DateTime();
                    $formattedDateTime = $currentDateTime->format('Ymd_His');
                    $fileName2 = $emp->getName() . '_' . $formattedDateTime . '.' . $profile->getClientOriginalExtension();
                    $emp->setProfilePic($fileName2);
                    $profile->move(
                        $this->getParameter('upload_directory'),
                        $fileName2
                    );
    
                    // Remove the old profile pic file if it exists
                    if ($existingProfilePic) {
                        $this->removeFile($existingProfilePic);
                    }
                }
            }
    
         //   $emp->setUpdatedAt(new DateTime());
    
            $entityManager->flush();
    
            // Add flash message
            $this->addFlash('success', 'Employee details updated successfully.');
    
            return $this->redirectToRoute('app_home');
        }
    
        return $this->render('frontend/edit.html.twig', [
            'form' => $form->createView(),
            'existingResume' => $existingResume,
            'existingProfilePic' => $existingProfilePic,
        ]);
    }
    
    private function removeFile($filename)
    {
        $filePath = $this->getParameter('upload_directory') . '/' . $filename;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
     
    #[Route('/delete/{id}', name: 'delete')]
    public function delete($id,EntityManagerInterface $entityManager): Response
    {
        $emp = $entityManager->getRepository(Employees::class)->find($id);
        if (!$emp) {
            throw $this->createNotFoundException('Entity not found');
        }
       
        
        $entityManager->remove($emp);
        $entityManager->flush();
        
        return $this->redirectToRoute('app_home');
    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('frontend/about.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
